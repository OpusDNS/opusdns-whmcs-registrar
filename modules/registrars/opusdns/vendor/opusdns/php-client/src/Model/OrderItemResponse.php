<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\Currency;
use OpusDNS\Client\Enum\MarketplaceDomainPurchasePublicReason;
use OpusDNS\Client\Enum\OrderItemType;
use OpusDNS\Client\Enum\OrderStatus;
use OpusDNS\Client\Serializer;

/**
 * The fields every item type has, plus one optional object named after `type`. A new type adds one
 * field.
 */
final class OrderItemResponse implements ApiModel
{
    /**
     * @param Currency|string $currency Currency of `price`
     * @param bool $deliveryAvailable Whether `GET /v1/orders/{order_id}/items/{item_id}/delivery` returns what the
     *     item delivers now
     * @param string $itemId TypeID prefix: order_item.
     * @param string $price Price of the item, a decimal string with two decimals
     * @param OrderStatus|string $status `pending` and `in_progress` are open, the others are final. Treat a value
     *     you do not know as open: statuses can be added.
     * @param OrderItemType|string $type Item type. More can be added.
     * @param MarketplaceDomainPurchaseDetail|null $marketplaceDomainPurchase Set when `type` is
     *     `marketplace_domain_purchase`
     * @param MarketplaceDomainPurchasePublicReason|string|null $reason Why the item was canceled or failed, or that
     *     an open item is slow. Null while the item is on track, or when no problem is known. Treat a value you do
     *     not know as `failed` on a final item and as `delayed` on an open one: reasons can be added.
     */
    public function __construct(
        public readonly Currency|string $currency,
        public readonly bool $deliveryAvailable,
        public readonly string $itemId,
        public readonly string $price,
        public readonly OrderStatus|string $status,
        public readonly OrderItemType|string $type,
        public readonly ?MarketplaceDomainPurchaseDetail $marketplaceDomainPurchase = null,
        public readonly MarketplaceDomainPurchasePublicReason|string|null $reason = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            currency: Currency::tryFrom($data['currency']) ?? $data['currency'],
            deliveryAvailable: $data['delivery_available'],
            itemId: $data['item_id'],
            price: $data['price'],
            status: OrderStatus::tryFrom($data['status']) ?? $data['status'],
            type: OrderItemType::tryFrom($data['type']) ?? $data['type'],
            marketplaceDomainPurchase: isset($data['marketplace_domain_purchase']) ? MarketplaceDomainPurchaseDetail::fromArray($data['marketplace_domain_purchase']) : null,
            reason: isset($data['reason']) ? MarketplaceDomainPurchasePublicReason::tryFrom($data['reason']) ?? $data['reason'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'currency' => $this->currency,
            'delivery_available' => $this->deliveryAvailable,
            'item_id' => $this->itemId,
            'price' => $this->price,
            'status' => $this->status,
            'type' => $this->type,
            'marketplace_domain_purchase' => $this->marketplaceDomainPurchase,
            'reason' => $this->reason,
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
