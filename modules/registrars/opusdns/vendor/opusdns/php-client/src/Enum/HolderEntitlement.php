<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum HolderEntitlement: string
{
    case OWNER = 'owner';
    case ASSIGNEE = 'assignee';
    case LICENSEE = 'licensee';
}
