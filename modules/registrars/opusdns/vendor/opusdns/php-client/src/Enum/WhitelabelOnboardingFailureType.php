<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum WhitelabelOnboardingFailureType: string
{
    case DNS = 'dns';
    case AUTH = 'auth';
    case BRANDING = 'branding';
    case SYSTEM = 'system';
}
