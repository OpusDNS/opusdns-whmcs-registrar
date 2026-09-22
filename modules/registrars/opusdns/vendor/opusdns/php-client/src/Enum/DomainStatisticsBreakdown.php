<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainStatisticsBreakdown: string
{
    case NONE = 'none';
    case ORGANIZATION = 'organization';
    case TLD = 'tld';
}
