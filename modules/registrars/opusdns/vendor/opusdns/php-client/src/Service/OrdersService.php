<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\OrderItemType;
use OpusDNS\Client\Enum\OrderSortField;
use OpusDNS\Client\Enum\OrderStatus;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Model\OrderCreate;
use OpusDNS\Client\Model\OrderItemDeliveryResponse;
use OpusDNS\Client\Model\OrderResponse;
use OpusDNS\Client\Model\PaginationOrderResponse;

/**
 * Operations tagged "orders".
 */
final class OrdersService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List orders
     *
     * Your organization's orders, newest first by default (see `sort_by` and `sort_order`).
     *
     * Required permissions: domains:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param OrderStatus|string|null $status Only orders with this status
     * @param OrderItemType|string|null $type Only orders with an item of this type
     * @param string|null $domain Only orders for this domain name (Unicode or ASCII form)
     * @param string|null $search Only orders whose domain name contains this text. `%` and `_` match themselves. A
     *     Unicode name also matches its punycode form, but a partial Unicode label finds nothing: orders store the
     *     ASCII form, and a partial label is converted as if it were whole (only whole labels match across forms).
     *     Does not match order IDs. Empty text matches every order. Combined with `domain`, both must match.
     * @param \DateTimeImmutable|null $createdAfter Only orders created at or after this time
     * @param \DateTimeImmutable|null $createdBefore Only orders created at or before this time
     * @param OrderSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listOrders(
        ?int $page = null,
        ?int $pageSize = null,
        OrderStatus|string|null $status = null,
        OrderItemType|string|null $type = null,
        ?string $domain = null,
        ?string $search = null,
        ?\DateTimeImmutable $createdAfter = null,
        ?\DateTimeImmutable $createdBefore = null,
        OrderSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $xDatetimeFormat = null,
    ): PaginationOrderResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORDERS,
            query: ['page' => $page, 'page_size' => $pageSize, 'status' => $status, 'type' => $type, 'domain' => $domain, 'search' => $search, 'created_after' => $createdAfter, 'created_before' => $createdBefore, 'sort_by' => $sortBy, 'sort_order' => $sortOrder],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationOrderResponse => PaginationOrderResponse::fromArray($data));
    }

    /**
     * Create an order
     *
     * Orders a domain listed on a marketplace. The order is accepted (202) once the price and availability
     * are confirmed; it then progresses on its own, follow it with `GET /v1/orders/{order_id}`.
     *
     * Repeating a request with the same `idempotency_key` and body returns the original order with 200.
     * The same key with a different body is refused with 409.
     *
     * Only organizations billed in EUR can order; others are refused with 403
     * `ERROR_ORDER_CURRENCY_NOT_SUPPORTED`.
     *
     * The order's price is reserved on the organization's account before the order is created; billing's
     * refusal (403 insufficient funds, 429 daily create limit) creates no order.
     *
     * Required permissions: domains:manage
     *
     * @param OrderCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function createOrder(OrderCreate|array $body, ?string $xDatetimeFormat = null): OrderResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::ORDERS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): OrderResponse => OrderResponse::fromArray($data));
    }

    /**
     * Get an order
     *
     * Required permissions: domains:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getOrder(string $orderId, ?string $xDatetimeFormat = null): OrderResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::ORDERS_BY_ORDER_ID,
            path: ['order_id' => $orderId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): OrderResponse => OrderResponse::fromArray($data));
    }

    /**
     * Get what an order item delivers
     *
     * Returns what an item delivers, in one object named after the item's `type`. For a
     * `marketplace_domain_purchase` that is the transfer auth code, for moving the domain to the registrar
     * of your choice. It can be read when the item's `delivery_available` is true; a 409 means it cannot
     * be read now. The caller needs `domains:manage` and `domain_auth_codes:read`. The response is never
     * cached (`Cache-Control: no-store`).
     *
     * Required permissions: domain_auth_codes:read, domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getOrderItemDelivery(
        string $orderId,
        string $itemId,
        ?string $xDatetimeFormat = null,
    ): OrderItemDeliveryResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORDERS_BY_ORDER_ID_ITEMS_BY_ITEM_ID_DELIVERY,
            path: ['order_id' => $orderId, 'item_id' => $itemId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): OrderItemDeliveryResponse => OrderItemDeliveryResponse::fromArray($data));
    }
}
