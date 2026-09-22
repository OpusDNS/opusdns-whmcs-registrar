<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\NizzaClaim;
use OpusDNS\Client\Enum\NizzaVerificationProof;
use OpusDNS\Client\Serializer;

final readonly class RequiredClaim implements ApiModel
{
    /**
     * @param NizzaClaim|string $claim Which contact claim the registry requires to have been verified
     * @param list<NizzaVerificationProof|string>|null $acceptedProofs The evidence the registry accepts for this
     *     claim; any proof is accepted when omitted
     */
    public function __construct(
        public NizzaClaim|string $claim,
        public ?array $acceptedProofs = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            claim: NizzaClaim::tryFrom($data['claim']) ?? $data['claim'],
            acceptedProofs: isset($data['accepted_proofs']) ? array_map(static fn (string $item): NizzaVerificationProof|string => NizzaVerificationProof::tryFrom($item) ?? $item, $data['accepted_proofs']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'claim' => $this->claim,
            'accepted_proofs' => $this->acceptedProofs,
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
