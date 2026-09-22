<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ContactVerificationClaim: string
{
    case NAME = 'NAME';
    case ADDRESS = 'ADDRESS';
    case EMAIL = 'EMAIL';
    case PHONE = 'PHONE';
    case LEGAL_ENTITY = 'LEGAL_ENTITY';
}
