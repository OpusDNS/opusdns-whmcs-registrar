<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ContactVerificationState: string
{
    case UNVERIFIED = 'UNVERIFIED';
    case VERIFIED = 'VERIFIED';
    case IN_PROGRESS = 'IN_PROGRESS';
    case EXPIRED = 'EXPIRED';
}
