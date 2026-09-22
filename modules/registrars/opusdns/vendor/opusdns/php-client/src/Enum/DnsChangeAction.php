<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DnsChangeAction: string
{
    case CREATE_ZONE = 'create_zone';
    case DELETE_ZONE = 'delete_zone';
    case CREATE_RECORD = 'create_record';
    case DELETE_RECORD = 'delete_record';
    case ENABLE_DNSSEC = 'enable_dnssec';
    case DISABLE_DNSSEC = 'disable_dnssec';
}
