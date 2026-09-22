<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum PostTransferRequirements: string
{
    case UPDATE_CONTACTS = 'update_contacts';
    case TLD_SPECIFIC = 'tld_specific';
}
