<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * `drop`: the zones that lost the most queries against the previous period; `rise`: those that gained
 * the most.
 */
enum DnsMoverDirection: string
{
    case DROP = 'drop';
    case RISE = 'rise';
}
