<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Order of the top zones: by queries, by queries answered with NXDOMAIN, or by the NXDOMAIN share of a
 * zone's queries.
 */
enum DnsZoneRank: string
{
    case QUERIES = 'queries';
    case NXDOMAINS = 'nxdomains';
    case NXDOMAIN_RATIO = 'nxdomain_ratio';
}
