<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum DnsOperation: string
{
    case UPSERT = 'upsert';
    case REMOVE = 'remove';
}
