<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainSortField: string
{
    case NAME = 'name';
    case CREATED_ON = 'created_on';
    case UPDATED_ON = 'updated_on';
    case EXPIRES_ON = 'expires_on';
    case REGISTERED_ON = 'registered_on';
    case TRANSFERRED_ON = 'transferred_on';
}
