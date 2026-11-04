<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainVerificationKind;
use OpusDNS\Client\Enum\DomainVerificationStatus;
use OpusDNS\Client\Enum\DomainVerificationTrigger;
use OpusDNS\Client\Enum\VerificationClaimType;
use OpusDNS\Client\Serializer;

final readonly class ActiveDomainVerificationResponse implements ApiModel
{
    /**
     * @param list<VerificationClaimType|string> $claims What has to be verified about the registrant
     * @param string $contactId The registrant contact the case is about TypeID prefix: contact.
     * @param list<VerificationDeadline> $deadlines The deadlines of the case
     * @param \DateTimeImmutable $openedOn When the case was opened
     * @param DomainVerificationKind|string $source Who asks for the verification: ICANN or the registry
     * @param DomainVerificationStatus|string $status The status of the case
     * @param DomainVerificationTrigger|string $trigger What opened the case
     * @param string $verificationId The ID of the verification case TypeID prefix: domain_verification.
     */
    public function __construct(
        public array $claims,
        public string $contactId,
        public array $deadlines,
        public \DateTimeImmutable $openedOn,
        public DomainVerificationKind|string $source,
        public DomainVerificationStatus|string $status,
        public DomainVerificationTrigger|string $trigger,
        public string $verificationId,
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
            openedOn: new \DateTimeImmutable($data['opened_on']),
            source: DomainVerificationKind::tryFrom($data['source']) ?? $data['source'],
            status: DomainVerificationStatus::tryFrom($data['status']) ?? $data['status'],
            trigger: DomainVerificationTrigger::tryFrom($data['trigger']) ?? $data['trigger'],
            verificationId: $data['verification_id'],
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
            'opened_on' => $this->openedOn,
            'source' => $this->source,
            'status' => $this->status,
            'trigger' => $this->trigger,
            'verification_id' => $this->verificationId,
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
