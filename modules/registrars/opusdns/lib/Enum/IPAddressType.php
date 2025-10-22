<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum IPAddressType: string
{
    case V4 = 'v4';
    case V6 = 'v6';
}
