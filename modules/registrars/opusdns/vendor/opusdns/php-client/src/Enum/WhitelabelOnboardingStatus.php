<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum WhitelabelOnboardingStatus: string
{
    case PENDING_DOMAIN_VERIFICATION = 'pending_domain_verification';
    case VERIFYING = 'verifying';
    case PROVISIONING = 'provisioning';
    case ACTIVE = 'active';
    case FAILED = 'failed';
    case TERMINATED = 'terminated';
}
