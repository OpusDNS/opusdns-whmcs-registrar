<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ContactVerificationClaim;
use OpusDNS\Client\Enum\ContactVerificationMethod;
use OpusDNS\Client\Enum\ContactVerificationProof;
use OpusDNS\Client\Enum\ContactVerificationState;
use OpusDNS\Client\Serializer;

final class ContactVerificationStatus implements ApiModel
{
    public function __construct(
        public readonly ContactVerificationClaim|string $claim,
        public readonly ContactVerificationState|string $state,
        public readonly ?string $attestationReference = null,
        public readonly ?ContactVerificationEidInformation $eid = null,
        public readonly ?\DateTimeImmutable $expiresOn = null,
        public readonly ContactVerificationMethod|string|null $method = null,
        public readonly ContactVerificationProof|string|null $proof = null,
        public readonly ?\DateTimeImmutable $verifiedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            claim: ContactVerificationClaim::tryFrom($data['claim']) ?? $data['claim'],
            state: ContactVerificationState::tryFrom($data['state']) ?? $data['state'],
            attestationReference: $data['attestation_reference'] ?? null,
            eid: isset($data['eid']) ? ContactVerificationEidInformation::fromArray($data['eid']) : null,
            expiresOn: isset($data['expires_on']) ? new \DateTimeImmutable($data['expires_on']) : null,
            method: isset($data['method']) ? ContactVerificationMethod::tryFrom($data['method']) ?? $data['method'] : null,
            proof: isset($data['proof']) ? ContactVerificationProof::tryFrom($data['proof']) ?? $data['proof'] : null,
            verifiedOn: isset($data['verified_on']) ? new \DateTimeImmutable($data['verified_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'claim' => $this->claim,
            'state' => $this->state,
            'attestation_reference' => $this->attestationReference,
            'eid' => $this->eid,
            'expires_on' => $this->expiresOn,
            'method' => $this->method,
            'proof' => $this->proof,
            'verified_on' => $this->verifiedOn,
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
