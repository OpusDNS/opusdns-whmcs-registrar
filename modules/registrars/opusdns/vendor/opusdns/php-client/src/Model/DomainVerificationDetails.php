<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\VerificationClaimType;
use OpusDNS\Client\Serializer;

final readonly class DomainVerificationDetails implements ApiModel
{
    /**
     * @param list<VerificationRegistrantDetails>|null $registrants
     * @param list<VerificationClaimType|string>|null $verificationClaims
     * @param list<VerificationDeadline>|null $verificationDeadlines
     */
    public function __construct(
        public string $domainId,
        public string $detailType = 'domain_verification',
        public ?array $registrants = null,
        public ?array $verificationClaims = null,
        public ?array $verificationDeadlines = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            domainId: $data['domain_id'],
            detailType: $data['detail_type'] ?? 'domain_verification',
            registrants: isset($data['registrants']) ? array_map(static fn (array $item): VerificationRegistrantDetails => VerificationRegistrantDetails::fromArray($item), $data['registrants']) : null,
            verificationClaims: isset($data['verification_claims']) ? array_map(static fn (string $item): VerificationClaimType|string => VerificationClaimType::tryFrom($item) ?? $item, $data['verification_claims']) : null,
            verificationDeadlines: isset($data['verification_deadlines']) ? array_map(static fn (array $item): VerificationDeadline => VerificationDeadline::fromArray($item), $data['verification_deadlines']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'domain_id' => $this->domainId,
            'detail_type' => $this->detailType,
            'registrants' => $this->registrants,
            'verification_claims' => $this->verificationClaims,
            'verification_deadlines' => $this->verificationDeadlines,
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
