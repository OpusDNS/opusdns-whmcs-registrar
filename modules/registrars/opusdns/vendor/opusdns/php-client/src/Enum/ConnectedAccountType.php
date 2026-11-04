<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Which domain-lifecycle product family an account bills against, orthogonal to the EPP backend.
 *
 * DEFAULT = the native `domain_lifecycle` product; AMS = the per-TLD `ams_domain_lifecycle` product
 * for domains migrated onto an OpusDNS account; RAS = the mirror / management-fee family.
 */
enum ConnectedAccountType: string
{
    case DEFAULT = 'default';
    case AMS = 'ams';
    case RAS = 'ras';
}
