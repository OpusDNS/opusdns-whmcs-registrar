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
 * Premium pricing details for a domain
 */
final readonly class PremiumPricingRes implements ApiModel
{
    /**
     * @param list<PremiumPriceEntryRes> $prices Premium prices per action
     */
    public function __construct(
        public array $prices,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            prices: array_map(static fn (array $item): PremiumPriceEntryRes => PremiumPriceEntryRes::fromArray($item), $data['prices']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'prices' => $this->prices,
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
