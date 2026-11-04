<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainVerificationCloseReason;
use OpusDNS\Client\Enum\DomainVerificationKind;
use OpusDNS\Client\Enum\DomainVerificationStatus;
use OpusDNS\Client\Enum\DomainVerificationTrigger;
use OpusDNS\Client\Enum\VerificationClaimType;
use OpusDNS\Client\Serializer;

final readonly class ContactVerificationCaseResponse implements ApiModel
{
    /**
     * @param list<VerificationClaimType|string> $claims What has to be verified about the registrant
     * @param string $contactId The registrant contact the case is about TypeID prefix: contact.
     * @param list<VerificationDeadline> $deadlines The deadlines of the case
     * @param string $domainId The domain the case is about TypeID prefix: domain.
     * @param string $domainName The name of the domain the case is about
     * @param \DateTimeImmutable $openedOn When the case was opened
     * @param int $remindersSent How many reminders the registrant got about this case
     * @param DomainVerificationKind|string $source Who asks for the verification: ICANN or the registry
     * @param DomainVerificationStatus|string $status The status of the case
     * @param DomainVerificationTrigger|string $trigger What opened the case
     * @param string $verificationId The ID of the verification case TypeID prefix: domain_verification.
     * @param DomainVerificationCloseReason|string|null $closeReason Why the case was closed, null while it is active
     * @param \DateTimeImmutable|null $closedOn When the case was closed, null while it is active
     * @param \DateTimeImmutable|null $lastReminderSentOn When the registrant's email was last reminded, null if
     *     never
     */
    public function __construct(
        public array $claims,
        public string $contactId,
        public array $deadlines,
        public string $domainId,
        public string $domainName,
        public \DateTimeImmutable $openedOn,
        public int $remindersSent,
        public DomainVerificationKind|string $source,
        public DomainVerificationStatus|string $status,
        public DomainVerificationTrigger|string $trigger,
        public string $verificationId,
        public DomainVerificationCloseReason|string|null $closeReason = null,
        public ?\DateTimeImmutable $closedOn = null,
        public ?\DateTimeImmutable $lastReminderSentOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            claims: array_map(static fn (string $item): VerificationClaimType|string => VerificationClaimType::tryFrom($item) ?? $item, $data['claims']),
            contactId: $data['contact_id'],
            deadlines: array_map(static fn (array $item): VerificationDeadline => VerificationDeadline::fromArray($item), $data['deadlines']),
            domainId: $data['domain_id'],
            domainName: $data['domain_name'],
            openedOn: new \DateTimeImmutable($data['opened_on']),
            remindersSent: $data['reminders_sent'],
            source: DomainVerificationKind::tryFrom($data['source']) ?? $data['source'],
            status: DomainVerificationStatus::tryFrom($data['status']) ?? $data['status'],
            trigger: DomainVerificationTrigger::tryFrom($data['trigger']) ?? $data['trigger'],
            verificationId: $data['verification_id'],
            closeReason: isset($data['close_reason']) ? DomainVerificationCloseReason::tryFrom($data['close_reason']) ?? $data['close_reason'] : null,
            closedOn: isset($data['closed_on']) ? new \DateTimeImmutable($data['closed_on']) : null,
            lastReminderSentOn: isset($data['last_reminder_sent_on']) ? new \DateTimeImmutable($data['last_reminder_sent_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'claims' => $this->claims,
            'contact_id' => $this->contactId,
            'deadlines' => $this->deadlines,
            'domain_id' => $this->domainId,
            'domain_name' => $this->domainName,
            'opened_on' => $this->openedOn,
            'reminders_sent' => $this->remindersSent,
            'source' => $this->source,
            'status' => $this->status,
            'trigger' => $this->trigger,
            'verification_id' => $this->verificationId,
            'close_reason' => $this->closeReason,
            'closed_on' => $this->closedOn,
            'last_reminder_sent_on' => $this->lastReminderSentOn,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
