<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\PremiumAffectsType;
use OpusDNS\Client\Enum\PremiumSourceType;
use OpusDNS\Client\Serializer;

final readonly class PremiumDomainsBase implements ApiModel
{
    /**
     * @param bool $supported Whether the registry has premium domains
     * @param list<PremiumAffectsType|string>|null $affects What operations are affected by premium status
     * @param PremiumSourceType|string|null $source Source of premium domain information
     */
    public function __construct(
        public bool $supported,
        public ?array $affects = null,
        public PremiumSourceType|string|null $source = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            supported: $data['supported'],
            affects: isset($data['affects']) ? array_map(static fn (string $item): PremiumAffectsType|string => PremiumAffectsType::tryFrom($item) ?? $item, $data['affects']) : null,
            source: isset($data['source']) ? PremiumSourceType::tryFrom($data['source']) ?? $data['source'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'supported' => $this->supported,
            'affects' => $this->affects,
            'source' => $this->source,
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
