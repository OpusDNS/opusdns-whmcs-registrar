<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Wire mirror of the domain `RenewalMode` vocabulary — local so dns_client doesn't pull schema
 * imports. The subscription itself has no renewal_mode column; api-nameserver derives this from
 * whether a renewal is scheduled.
 */
enum RenewalModeDTO: string
{
    case RENEW = 'renew';
    case EXPIRE = 'expire';
}
