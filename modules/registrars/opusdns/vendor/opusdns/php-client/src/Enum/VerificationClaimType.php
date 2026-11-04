<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum VerificationClaimType: string
{
    case NAME = 'name';
    case LEGAL_ENTITY = 'legal_entity';
    case ADDRESS = 'address';
    case EMAIL = 'email';
    case PHONE = 'phone';
}
