<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum NizzaClaim: string
{
    case EMAIL = 'EMAIL';
    case PHONE = 'PHONE';
    case ADDRESS = 'ADDRESS';
    case NAME = 'NAME';
    case LEGAL_ENTITY = 'LEGAL_ENTITY';
}
