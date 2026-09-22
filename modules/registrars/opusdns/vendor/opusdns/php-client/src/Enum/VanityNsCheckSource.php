<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum VanityNsCheckSource: string
{
    case PUBLIC_DNS = 'public_dns';
    case AUTHORITATIVE_DNS = 'authoritative_dns';
    case REGISTRY_EPP = 'registry_epp';
}
