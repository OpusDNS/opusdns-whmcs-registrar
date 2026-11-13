<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * What an API caller sees of why an item is not going as planned; the meanings are in
 * docs/api/orders.md.
 */
enum MarketplaceDomainPurchasePublicReason: string
{
    case PRICE_CHANGED = 'price_changed';
    case UNAVAILABLE = 'unavailable';
    case CANCELED_BY_MARKETPLACE = 'canceled_by_marketplace';
    case FAILED = 'failed';
    case DELAYED = 'delayed';
}
