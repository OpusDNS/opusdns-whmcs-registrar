<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ContactVerificationMethod: string
{
    case AUTH = 'AUTH';
    case VDIG = 'VDIG';
    case ELECTRONIC_DOCUMENT = 'ELECTRONIC_DOCUMENT';
    case PHYSICAL_DOCUMENT = 'PHYSICAL_DOCUMENT';
    case BVR = 'BVR';
    case PVR = 'PVR';
    case DATA = 'DATA';
    case REACHABILITY = 'REACHABILITY';
}
