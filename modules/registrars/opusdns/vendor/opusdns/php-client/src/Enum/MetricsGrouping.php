<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum MetricsGrouping: string
{
    case URL = 'url';
    case FQDN = 'fqdn';
    case DOMAIN = 'domain';
    case FORWARD = 'forward';
    case RULE = 'rule';
}
