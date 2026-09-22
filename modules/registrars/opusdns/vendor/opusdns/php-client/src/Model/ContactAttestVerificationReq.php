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
use OpusDNS\Client\Serializer;

final readonly class ContactAttestVerificationReq implements ApiModel
{
    public function __construct(
        public string $attestationReference,
        public ContactVerificationClaim|string $claim,
        public ContactVerificationMethod|string $method,
        public ContactVerificationProof|string $proof,
        public ?ContactVerificationEidInformation $eid = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            attestationReference: $data['attestation_reference'],
            claim: ContactVerificationClaim::tryFrom($data['claim']) ?? $data['claim'],
            method: ContactVerificationMethod::tryFrom($data['method']) ?? $data['method'],
            proof: ContactVerificationProof::tryFrom($data['proof']) ?? $data['proof'],
            eid: isset($data['eid']) ? ContactVerificationEidInformation::fromArray($data['eid']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'attestation_reference' => $this->attestationReference,
            'claim' => $this->claim,
            'method' => $this->method,
            'proof' => $this->proof,
            'eid' => $this->eid,
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
