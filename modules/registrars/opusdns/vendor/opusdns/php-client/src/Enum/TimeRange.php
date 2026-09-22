<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum TimeRange: string
{
    case _1H = '1h';
    case _1D = '1d';
    case _7D = '7d';
    case _30D = '30d';
    case _1Y = '1y';
}
