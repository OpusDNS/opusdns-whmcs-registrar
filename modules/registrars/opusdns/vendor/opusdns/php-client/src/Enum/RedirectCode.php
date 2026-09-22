<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum RedirectCode: int
{
    case _301 = 301;
    case _302 = 302;
    case _307 = 307;
    case _308 = 308;
}
