<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class LaunchPhasesBase implements ApiModel
{
    /**
     * @param list<LaunchPhaseBase> $phases
     */
    public function __construct(
        public GeneralAvailabilityBase $generalAvailability,
        public array $phases = [],
        public ?TrademarkClaimsBase $trademarkClaims = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            generalAvailability: GeneralAvailabilityBase::fromArray($data['general_availability']),
            phases: isset($data['phases']) ? array_map(static fn (array $item): LaunchPhaseBase => LaunchPhaseBase::fromArray($item), $data['phases']) : [],
            trademarkClaims: isset($data['trademark_claims']) ? TrademarkClaimsBase::fromArray($data['trademark_claims']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'general_availability' => $this->generalAvailability,
            'phases' => $this->phases,
            'trademark_claims' => $this->trademarkClaims,
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
