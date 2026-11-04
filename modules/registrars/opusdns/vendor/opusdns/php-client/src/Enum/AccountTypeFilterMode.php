<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * How an `account_type` filter applies; no `match_all`, since a domain has exactly one account type.
 */
enum AccountTypeFilterMode: string
{
    case MATCH_ANY = 'match_any';
    case MATCH_NONE = 'match_none';
}
