<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainIncludeField: string
{
    case TAGS = 'tags';
    case RENEWAL_PRICE = 'renewal_price';
    case CONNECTED_ACCOUNT = 'connected_account';
    case REGISTRANT_CHANGE = 'registrant_change';
}
