<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainAvailabilityStatus: string
{
    case AVAILABLE = 'available';
    case UNAVAILABLE = 'unavailable';
    case MARKET_AVAILABLE = 'market_available';
    case TMCH_CLAIM = 'tmch_claim';
    case ERROR = 'error';
    case UNKNOWN = 'unknown';
}
