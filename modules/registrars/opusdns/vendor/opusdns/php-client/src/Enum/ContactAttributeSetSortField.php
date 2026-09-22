<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ContactAttributeSetSortField: string
{
    case LABEL = 'label';
    case TLD = 'tld';
    case CREATED_ON = 'created_on';
    case UPDATED_ON = 'updated_on';
}
