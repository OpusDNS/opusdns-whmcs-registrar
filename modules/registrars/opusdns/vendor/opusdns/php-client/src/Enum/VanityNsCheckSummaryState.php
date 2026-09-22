<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Top-level verdict synthesized from the individual checks.
 */
enum VanityNsCheckSummaryState: string
{
    case READY = 'ready';
    case PROPAGATING = 'propagating';
    case ACTION_REQUIRED = 'action_required';
    case DEGRADED = 'degraded';
}
