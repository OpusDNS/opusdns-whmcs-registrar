<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ReportTriggerType: string
{
    case ON_DEMAND = 'on_demand';
    case SCHEDULED = 'scheduled';
}
