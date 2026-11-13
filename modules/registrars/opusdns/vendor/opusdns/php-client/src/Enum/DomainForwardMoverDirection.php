<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * `drop`: the domains that lost the most redirects against the previous period; `rise`: those that
 * gained the most.
 */
enum DomainForwardMoverDirection: string
{
    case DROP = 'drop';
    case RISE = 'rise';
}
