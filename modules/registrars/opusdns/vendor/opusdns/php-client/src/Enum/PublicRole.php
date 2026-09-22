<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum PublicRole: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case VIEWER = 'viewer';
    case DOMAIN_MANAGER = 'domain_manager';
    case DNS_MANAGER = 'dns_manager';
    case BILLING_MANAGER = 'billing_manager';
}
