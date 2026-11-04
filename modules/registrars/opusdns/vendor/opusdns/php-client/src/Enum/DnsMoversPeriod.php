<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * The movers compare a period with the one of the same length before it.
 */
enum DnsMoversPeriod: string
{
    case _7D = '7d';
    case _30D = '30d';
}
