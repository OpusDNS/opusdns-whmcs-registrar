<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DnsProtectedReason: string
{
    case SYSTEM_MANAGED_SOA = 'SYSTEM_MANAGED_SOA';
    case SYSTEM_MANAGED_NS = 'SYSTEM_MANAGED_NS';
    case EMAIL_FORWARD = 'EMAIL_FORWARD';
    case DOMAIN_FORWARD = 'DOMAIN_FORWARD';
    case WHITELABEL = 'WHITELABEL';
    case GENERIC = 'GENERIC';
}
