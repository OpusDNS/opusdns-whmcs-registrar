<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\OrderItemType;
use OpusDNS\Client\Serializer;

/**
 * What an order item delivers: `type` plus one object named after it. Only ever the body of the
 * delivery endpoint.
 */
final class OrderItemDeliveryResponse implements ApiModel
{
    /**
     * @param OrderItemType|string $type Item type. More can be added.
     * @param MarketplaceDomainPurchaseDelivery|null $marketplaceDomainPurchase Set when `type` is
     *     `marketplace_domain_purchase`
     */
    public function __construct(
        public readonly OrderItemType|string $type,
        public readonly ?MarketplaceDomainPurchaseDelivery $marketplaceDomainPurchase = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            type: OrderItemType::tryFrom($data['type']) ?? $data['type'],
            marketplaceDomainPurchase: isset($data['marketplace_domain_purchase']) ? MarketplaceDomainPurchaseDelivery::fromArray($data['marketplace_domain_purchase']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'type' => $this->type,
            'marketplace_domain_purchase' => $this->marketplaceDomainPurchase,
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
