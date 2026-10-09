<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Enum\EventObjectType;
use OpusDNS\Client\Enum\EventSortField;
use OpusDNS\Client\Enum\EventSubtype;
use OpusDNS\Client\Enum\EventType;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Model\EventResponse;
use OpusDNS\Client\Paginator;
use RuntimeException;
use Throwable;
use WHMCS\Database\Capsule;
use WHMCS\Module\Registrar\OpusDNS\ApiClientFactory;
use WHMCS\Module\Registrar\OpusDNS\Helper\ErrorHelper;

/**
 * Applies the pending OpusDNS domain events to the WHMCS domains of the module and acknowledges them.
 *
 * Events are processed oldest first. An event is acknowledged once it is applied, or when its domain is not an
 * OpusDNS domain in WHMCS. An event that fails to apply stays pending and is retried on the next run.
 *
 * Only SUCCESS events are fetched. Status changes by event type:
 * - DELETION: Cancelled
 * - OUTBOUND_TRANSFER, TRANSIT, WITHDRAW: Transferred Away
 * Every event is written to the activity log of the domain's client.
 */
class DomainEvents
{
    public const HANDLED_TYPES = [
        EventType::DELETION,
        EventType::OUTBOUND_TRANSFER,
        EventType::TRANSIT,
        EventType::WITHDRAW,
    ];
    private const PAGE_SIZE = 250;
    private const MAX_PAGES_PER_TYPE = 100;
    private const STATUS_CANCELLED = 'Cancelled';
    private const STATUS_TRANSFERRED_AWAY = 'Transferred Away';

    /**
     * @return array{processed: int, failed: int}
     */
    public function process(): array
    {
        $processedCount = 0;
        $failedCount = 0;
        $api = ApiClientFactory::fromRegistrarSettings();

        if ($api === null) {
            return ['processed' => $processedCount, 'failed' => $failedCount];
        }

        foreach ($this->pendingEvents($api) as $event) {
            try {
                $this->apply($event);
                $api->event()->acknowledgeEvent((string) $event->eventId);
                $processedCount++;
            } catch (Throwable $exception) {
                $failedCount++;
                logActivity(sprintf(
                    'OpusDNS: processing event %s for %s failed: %s',
                    $event->eventId,
                    $event->objectId,
                    ErrorHelper::message($exception),
                ));
            }
        }

        return ['processed' => $processedCount, 'failed' => $failedCount];
    }

    /**
     * The unacknowledged SUCCESS domain events of the handled types that carry an event and object id, oldest first.
     *
     * @return list<EventResponse>
     */
    public function pendingEvents(Client $api): array
    {
        $events = [];

        foreach (self::HANDLED_TYPES as $eventType) {
            $eventsOfType = Paginator::items(
                fn (int $page) => $api->event()->getEvents(
                    page: $page,
                    pageSize: self::PAGE_SIZE,
                    sortBy: EventSortField::CREATED_ON,
                    sortOrder: SortOrder::ASC,
                    objectType: EventObjectType::DOMAIN,
                    type: $eventType,
                    subtype: EventSubtype::SUCCESS,
                    acknowledged: false,
                ),
                maxPages: self::MAX_PAGES_PER_TYPE,
            );

            foreach ($eventsOfType as $event) {
                if ($event->eventId !== null && $event->objectId !== null) {
                    $events[] = $event;
                }
            }
        }

        usort(
            $events,
            static fn (EventResponse $first, EventResponse $second): int => $first->createdOn <=> $second->createdOn,
        );

        return $events;
    }

    private function apply(EventResponse $event): void
    {
        $domainName = strtolower((string) $event->objectId);
        $domain = Capsule::table('tbldomains')
            ->where('registrar', ApiClientFactory::REGISTRAR)
            ->where('domain', $domainName)
            ->orderByDesc('id')
            ->first(['id', 'userid']);

        if ($domain === null) {
            return;
        }

        $changes = $this->domainChanges($event);

        if ($changes !== []) {
            $result = localAPI('UpdateClientDomain', ['domainid' => $domain->id] + $changes);

            if (($result['result'] ?? '') !== 'success') {
                throw new RuntimeException((string) ($result['message'] ?? 'UpdateClientDomain failed'));
            }
        }

        logActivity($this->activityMessage($domainName, (int) $domain->id, $event, $changes), (int) $domain->userid);
    }

    /**
     * The UpdateClientDomain fields the event sets on the WHMCS domain.
     *
     * @return array<string, string>
     */
    private function domainChanges(EventResponse $event): array
    {
        return match ($event->type) {
            EventType::DELETION => ['status' => self::STATUS_CANCELLED],
            EventType::OUTBOUND_TRANSFER, EventType::TRANSIT, EventType::WITHDRAW
                => ['status' => self::STATUS_TRANSFERRED_AWAY],
            default => [],
        };
    }

    /**
     * @param array<string, string> $changes
     */
    private function activityMessage(string $domainName, int $domainId, EventResponse $event, array $changes): string
    {
        $eventType = $event->type instanceof EventType ? $event->type->value : (string) $event->type;
        $subtype = $event->subtype instanceof EventSubtype ? $event->subtype->value : (string) $event->subtype;
        $message = sprintf(
            'OpusDNS: %s %s event for %s (Domain ID: %d): %s',
            $eventType,
            $subtype,
            $domainName,
            $domainId,
            $event->eventData->message,
        );

        $error = $event->eventData->error;
        if ($error !== null) {
            $message .= sprintf(' (%s: %s)', $error->code, $error->detail);
        }

        if ($changes !== []) {
            $changeDescriptions = [];
            foreach ($changes as $field => $value) {
                $changeDescriptions[] = "{$field} set to {$value}";
            }
            $message .= '; ' . implode(', ', $changeDescriptions);
        }

        return $message;
    }
}
