<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainForwardSortField: string
{
    case HOSTNAME = 'hostname';
    case ENABLED = 'enabled';
    case CREATED_ON = 'created_on';
    case UPDATED_ON = 'updated_on';
}
