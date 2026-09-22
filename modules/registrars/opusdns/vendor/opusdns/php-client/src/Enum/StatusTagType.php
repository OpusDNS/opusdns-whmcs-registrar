<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum StatusTagType: string
{
    case VERIFICATION_REQUIRED = 'VERIFICATION_REQUIRED';
    case CREATE_REQUESTED = 'CREATE_REQUESTED';
    case INBOUND_TRANSFER_PENDING = 'INBOUND_TRANSFER_PENDING';
    case OUTBOUND_TRANSFER_PENDING = 'OUTBOUND_TRANSFER_PENDING';
    case EXTERNAL = 'EXTERNAL';
    case IMPORT_REQUESTED = 'IMPORT_REQUESTED';
    case IMPORT_PENDING = 'IMPORT_PENDING';
    case DNSSEC_PENDING = 'DNSSEC_PENDING';
}
