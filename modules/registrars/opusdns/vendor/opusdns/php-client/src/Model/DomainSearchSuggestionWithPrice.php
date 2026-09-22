<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainSearchSuggestionWithPrice implements ApiModel
{
    public function __construct(
        public bool $available,
        public string $domain,
        public bool $premium,
        public DomainSearchSuggestionPriceData $price,
        public ?DomainSearchSuggestionPriceData $renewalPrice = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            available: $data['available'],
            domain: $data['domain'],
            premium: $data['premium'],
            price: DomainSearchSuggestionPriceData::fromArray($data['price']),
            renewalPrice: isset($data['renewal_price']) ? DomainSearchSuggestionPriceData::fromArray($data['renewal_price']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'available' => $this->available,
            'domain' => $this->domain,
            'premium' => $this->premium,
            'price' => $this->price,
            'renewal_price' => $this->renewalPrice,
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
