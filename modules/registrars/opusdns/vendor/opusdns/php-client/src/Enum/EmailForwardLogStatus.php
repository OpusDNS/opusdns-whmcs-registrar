<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum EmailForwardLogStatus: string
{
    case UNKNOWN = 'UNKNOWN';
    case QUEUED = 'QUEUED';
    case DELIVERED = 'DELIVERED';
    case REFUSED = 'REFUSED';
    case SOFT_BOUNCE = 'SOFT-BOUNCE';
    case HARD_BOUNCE = 'HARD-BOUNCE';
}
