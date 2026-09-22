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
 * A single premium price entry for a specific action
 */
final readonly class PremiumPriceEntryRes implements ApiModel
{
    /**
     * @param string $action The action (e.g., create, renew, transfer)
     * @param string $currency Currency of the price
     * @param string $price Customer-facing price after markup
     */
    public function __construct(
        public string $action,
        public string $currency,
        public string $price,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            action: $data['action'],
            currency: $data['currency'],
            price: $data['price'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'action' => $this->action,
            'currency' => $this->currency,
            'price' => $this->price,
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
