<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum EventObjectType: string
{
    case DOMAIN = 'DOMAIN';
    case CONTACT = 'CONTACT';
    case HOST = 'HOST';
    case ACCOUNT = 'ACCOUNT';
    case VANITY_NS_SET = 'VANITY_NS_SET';
    case RAW = 'RAW';
    case UNKNOWN = 'UNKNOWN';
}
