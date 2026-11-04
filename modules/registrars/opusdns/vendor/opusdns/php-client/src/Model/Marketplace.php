<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\MarketplaceName;
use OpusDNS\Client\Serializer;

/**
 * The marketplace a domain is for sale on.
 */
final readonly class Marketplace implements ApiModel
{
    /**
     * @param MarketplaceName|string $name Name of the marketplace
     */
    public function __construct(
        public MarketplaceName|string $name,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: MarketplaceName::tryFrom($data['name']) ?? $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
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
