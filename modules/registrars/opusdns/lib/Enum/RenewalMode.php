<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum RenewalMode: string
{
    case RENEW = 'renew';
    case EXPIRE = 'expire';
    case DELETE = 'delete';
}
