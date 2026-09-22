<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum HostStatus: string
{
    case REQUESTED_CREATE = 'requested_create';
    case PENDING_CREATE = 'pending_create';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING_DELETE = 'pending_delete';
}
