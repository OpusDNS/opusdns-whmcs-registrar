<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum TagFilterMode: string
{
    case MATCH_ANY = 'match_any';
    case MATCH_ALL = 'match_all';
    case MATCH_NONE = 'match_none';
}
