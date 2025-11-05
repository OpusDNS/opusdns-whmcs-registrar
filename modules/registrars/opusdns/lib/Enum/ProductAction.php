<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum ProductAction: string
{
    case APPLICATION = 'application';
    case CREATE = 'create';
    case RENEW = 'renew';
    case TRANSFER = 'transfer';
    case TRADE = 'trade';
    case RESTORE = 'restore';
}
