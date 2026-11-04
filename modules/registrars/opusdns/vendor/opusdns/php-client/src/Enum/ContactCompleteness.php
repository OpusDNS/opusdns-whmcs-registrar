<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Whether a stored contact passes the contact create validation (`classify`).
 */
enum ContactCompleteness: string
{
    case COMPLETE = 'complete';
    case INCOMPLETE = 'incomplete';
}
