<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum BillingTransactionSortField: string
{
    case PRODUCT_TYPE = 'product_type';
    case ACTION = 'action';
    case STATUS = 'status';
    case CREATED_ON = 'created_on';
    case COMPLETED_ON = 'completed_on';
}
