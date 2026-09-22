<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * Response for checking parking signup status.
 */
final readonly class ParkingSignupStatusResponse implements ApiModel
{
    /**
     * @param bool $hasAcceptedAgreement Whether the organization has accepted the parking agreement
     * @param \DateTimeImmutable|null $acceptedAt When the agreement was accepted
     * @param string|null $agreementVersion Version of the accepted agreement
     */
    public function __construct(
        public bool $hasAcceptedAgreement,
        public ?\DateTimeImmutable $acceptedAt = null,
        public ?string $agreementVersion = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            hasAcceptedAgreement: $data['has_accepted_agreement'],
            acceptedAt: isset($data['accepted_at']) ? new \DateTimeImmutable($data['accepted_at']) : null,
            agreementVersion: $data['agreement_version'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'has_accepted_agreement' => $this->hasAcceptedAgreement,
            'accepted_at' => $this->acceptedAt,
            'agreement_version' => $this->agreementVersion,
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
