<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum UserSortField: string
{
    case CREATED_ON = 'created_on';
    case USERNAME = 'username';
    case EMAIL = 'email';
}
