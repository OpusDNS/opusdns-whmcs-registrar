<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum ProductType: string
{
    case DOMAIN = 'domain';
    case ZONES = 'zones';
    case EMAIL_FORWARD = 'email_forward';
    case DOMAIN_FORWARD = 'domain_forward';
}
