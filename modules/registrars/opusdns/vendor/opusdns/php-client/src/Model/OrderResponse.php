<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\Currency;
use OpusDNS\Client\Enum\OrderStatus;
use OpusDNS\Client\Serializer;

final class OrderResponse implements ApiModel
{
    /**
     * @param list<OrderItemResponse> $items The items of the order. Empty only in a `GET /v1/orders` list entry for
     *     an order that cannot be shown: contact support with the order ID.
     * @param string $orderId TypeID prefix: order.
     * @param OrderStatus|string $status `pending` and `in_progress` are open, the others are final. Treat a value
     *     you do not know as open: statuses can be added.
     * @param Currency|string|null $currency Currency of `total_price` and of every item price. Null only in a `GET
     *     /v1/orders` list entry for an order that cannot be shown: contact support with the order ID.
     * @param string|null $totalPrice Sum of the item prices, a decimal string with two decimals. Null only in a `GET
     *     /v1/orders` list entry for an order that cannot be shown: contact support with the order ID.
     */
    public function __construct(
        public readonly \DateTimeImmutable $createdOn,
        public readonly array $items,
        public readonly string $orderId,
        public readonly OrderStatus|string $status,
        public readonly \DateTimeImmutable $updatedOn,
        public readonly Currency|string|null $currency = null,
        public readonly ?string $totalPrice = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            items: array_map(static fn (array $item): OrderItemResponse => OrderItemResponse::fromArray($item), $data['items']),
            orderId: $data['order_id'],
            status: OrderStatus::tryFrom($data['status']) ?? $data['status'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            currency: isset($data['currency']) ? Currency::tryFrom($data['currency']) ?? $data['currency'] : null,
            totalPrice: $data['total_price'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'items' => $this->items,
            'order_id' => $this->orderId,
            'status' => $this->status,
            'updated_on' => $this->updatedOn,
            'currency' => $this->currency,
            'total_price' => $this->totalPrice,
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
