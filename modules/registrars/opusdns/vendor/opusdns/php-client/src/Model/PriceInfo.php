<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class PriceInfo implements ApiModel
{
    /**
     * @param PricingPeriod|null $period Pricing period (e.g., 1 year, 2 months)
     */
    public function __construct(
        public string $currency,
        public string $price,
        public string $productType,
        public ?PricingPeriod $period = null,
        public ?string $productAction = null,
        public ?string $productClass = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            currency: $data['currency'],
            price: $data['price'],
            productType: $data['product_type'],
            period: isset($data['period']) ? PricingPeriod::fromArray($data['period']) : null,
            productAction: $data['product_action'] ?? null,
            productClass: $data['product_class'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'currency' => $this->currency,
            'price' => $this->price,
            'product_type' => $this->productType,
            'period' => $this->period,
            'product_action' => $this->productAction,
            'product_class' => $this->productClass,
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
