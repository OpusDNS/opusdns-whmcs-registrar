<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * A fixed window of whole UTC days ending on the newest day with data (`period_end`).
 */
enum DnsStatisticsPeriod: string
{
    case _7D = '7d';
    case _30D = '30d';
    case _90D = '90d';
}
