<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainVerificationKind;
use OpusDNS\Client\Enum\VerificationClaimType;
use OpusDNS\Client\Serializer;

final class DomainVerificationDetails implements ApiModel
{
    /**
     * @param list<VerificationRegistrantDetails>|null $registrants
     * @param list<VerificationClaimType|string>|null $verificationClaims
     * @param list<VerificationDeadline>|null $verificationDeadlines
     */
    public function __construct(
        public readonly string $domainId,
        public readonly string $detailType = 'domain_verification',
        public readonly ?array $registrants = null,
        public readonly DomainVerificationKind|string|null $source = null,
        public readonly ?array $verificationClaims = null,
        public readonly ?array $verificationDeadlines = null,
        public readonly ?string $verificationId = null,
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
            source: isset($data['source']) ? DomainVerificationKind::tryFrom($data['source']) ?? $data['source'] : null,
            verificationClaims: isset($data['verification_claims']) ? array_map(static fn (string $item): VerificationClaimType|string => VerificationClaimType::tryFrom($item) ?? $item, $data['verification_claims']) : null,
            verificationDeadlines: isset($data['verification_deadlines']) ? array_map(static fn (array $item): VerificationDeadline => VerificationDeadline::fromArray($item), $data['verification_deadlines']) : null,
            verificationId: $data['verification_id'] ?? null,
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
            'source' => $this->source,
            'verification_claims' => $this->verificationClaims,
            'verification_deadlines' => $this->verificationDeadlines,
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
