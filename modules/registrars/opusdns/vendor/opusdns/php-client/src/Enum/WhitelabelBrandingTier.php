<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Which tier a whitelabel config is on. One config per organization, one tier at a time.
 *
 * BASE serves the customer on a subdomain of an OpusDNS-owned zone; PLUS serves them on their own
 * domain. A whitelabel switches between the two in place (a plan change), so `tier` is a mutable
 * attribute of the single config row, never a discriminator between two rows. Deliberately stored
 * rather than inferred from the hostname, so a base-zone rename can never re-route the row down the
 * wrong onboarding path.
 */
enum WhitelabelBrandingTier: string
{
    case BASE = 'base';
    case PLUS = 'plus';
}
