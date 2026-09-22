<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ProductCreateRes implements ApiModel
{
    /**
     * @param string $productName The product name
     * @param string $subscribableId The created resource ID
     * @param string $subscriptionId The created subscription ID TypeID prefix: subscription.
     */
    public function __construct(
        public string $productName,
        public string $subscribableId,
        public string $subscriptionId,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            productName: $data['product_name'],
            subscribableId: $data['subscribable_id'],
            subscriptionId: $data['subscription_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'product_name' => $this->productName,
            'subscribable_id' => $this->subscribableId,
            'subscription_id' => $this->subscriptionId,
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
