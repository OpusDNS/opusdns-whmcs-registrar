<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * A product that is not generally available and is reached through the waitlist.
 *
 * The member value is the wire form used in URLs and API bodies; the column persists the member NAME
 * (StringEnum binds `value.name`), so renaming a member is a data migration.
 */
enum WaitlistProduct: string
{
    case AI_CONCIERGE = 'ai_concierge';
}
