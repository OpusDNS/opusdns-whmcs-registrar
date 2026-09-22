<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum LocalPresenceRequirementType: string
{
    case PHYSICAL_ADDRESS = 'physical_address';
    case BUSINESS_ENTITY = 'business_entity';
}
