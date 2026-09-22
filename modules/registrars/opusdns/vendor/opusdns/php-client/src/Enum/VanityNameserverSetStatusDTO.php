<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Wire mirror of `VanityNameserverSetStatus` — local so dns_client doesn't pull schema imports.
 */
enum VanityNameserverSetStatusDTO: string
{
    case PROVISIONING = 'provisioning';
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case FAILED = 'failed';
    case DELETING = 'deleting';
}
