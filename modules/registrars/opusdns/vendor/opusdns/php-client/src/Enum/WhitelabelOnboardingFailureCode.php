<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Stable, frontend-facing reason a terminal onboarding failure happened. The free-text detail that
 * accompanies it is for support/debugging, never for customer display.
 */
enum WhitelabelOnboardingFailureCode: string
{
    case ZONE_NOT_OWNED = 'zone_not_owned';
    case DELEGATION_MISSING = 'delegation_missing';
    case DELEGATION_MISMATCH = 'delegation_mismatch';
    case ZONE_CREATE_FAILED = 'zone_create_failed';
    case DNS_RECORD_REJECTED = 'dns_record_rejected';
    case AUTH_CLIENT_REJECTED = 'auth_client_rejected';
    case BRANDING_REJECTED = 'branding_rejected';
    case RETRIES_EXHAUSTED = 'retries_exhausted';
}
