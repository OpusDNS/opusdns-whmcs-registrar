<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum BillingTransactionAction: string
{
    case CREATE = 'create';
    case TRANSFER = 'transfer';
    case IMPORT = 'import';
    case RENEW = 'renew';
    case RESTORE = 'restore';
    case TRADE = 'trade';
    case APPLICATION = 'application';
    case SERVICE_FEE = 'service_fee';
    case UPGRADE_FEE = 'upgrade_fee';
    case WALLET_TOP_UP = 'wallet_top_up';
}
