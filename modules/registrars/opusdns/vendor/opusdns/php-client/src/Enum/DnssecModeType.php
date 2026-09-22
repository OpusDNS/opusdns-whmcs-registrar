<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DnssecModeType: string
{
    case DS = 'DS';
    case DNSKEY = 'DNSKEY';
}
