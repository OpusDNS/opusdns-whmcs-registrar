<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\EventObjectType;
use OpusDNS\Client\Enum\EventSortField;
use OpusDNS\Client\Enum\EventSubtype;
use OpusDNS\Client\Enum\EventType;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Model\EventResponse;
use OpusDNS\Client\Model\PaginationEventResponse;

/**
 * Operations tagged "event".
 */
final class EventService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Get pending events
     *
     * Retrieves a paginated list of events for the organization
     *
     * Required permissions: events:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param EventSortField|string|null $sortBy Server default: created_on.
     * @param SortOrder|string|null $sortOrder Server default: desc.
     * @param bool|null $acknowledged Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getEvents(
        ?int $page = null,
        ?int $pageSize = null,
        EventSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        EventObjectType|string|null $objectType = null,
        ?string $objectId = null,
        EventType|string|null $type = null,
        EventSubtype|string|null $subtype = null,
        ?bool $acknowledged = null,
        ?string $xDatetimeFormat = null,
    ): PaginationEventResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::EVENTS,
            query: ['page' => $page, 'page_size' => $pageSize, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'object_type' => $objectType, 'object_id' => $objectId, 'type' => $type, 'subtype' => $subtype, 'acknowledged' => $acknowledged],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationEventResponse => PaginationEventResponse::fromArray($data));
    }

    /**
     * Get event
     *
     * Get an event by its ID
     *
     * Required permissions: events:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getEvent(string $eventId, ?string $xDatetimeFormat = null): EventResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::EVENTS_BY_EVENT_ID,
            path: ['event_id' => $eventId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): EventResponse => EventResponse::fromArray($data));
    }

    /**
     * Acknowledge event
     *
     * Acknowledge an event
     *
     * Required permissions: events:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function acknowledgeEvent(string $eventId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'PATCH',
            Endpoint::EVENTS_BY_EVENT_ID,
            path: ['event_id' => $eventId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }
}
