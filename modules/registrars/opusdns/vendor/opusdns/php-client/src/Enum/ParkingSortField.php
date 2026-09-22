<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ParkingSortField: string
{
    case DOMAIN = 'domain';
    case CREATED_ON = 'created_on';
    case UPDATED_ON = 'updated_on';
}
