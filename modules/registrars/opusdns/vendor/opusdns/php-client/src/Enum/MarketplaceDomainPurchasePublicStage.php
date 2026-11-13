<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * What an API caller sees of an item's progress.
 */
enum MarketplaceDomainPurchasePublicStage: string
{
    case PROCESSING = 'processing';
    case PURCHASING = 'purchasing';
    case AWAITING_CODE = 'awaiting_code';
    case CODE_READY = 'code_ready';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELED = 'canceled';
}
