<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum EventSubtype: string
{
    case NOTIFICATION = 'NOTIFICATION';
    case SUCCESS = 'SUCCESS';
    case FAILURE = 'FAILURE';
    case CANCELED = 'CANCELED';
}
