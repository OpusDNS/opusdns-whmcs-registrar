<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum TransferAckType: string
{
    case NONE = 'none';
    case REGISTRAR = 'registrar';
    case REGISTRANT = 'registrant';
    case BOTH = 'both';
}
