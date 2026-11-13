<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * The top list to add: `none`, or the dimension to group the redirects by.
 */
enum DomainForwardStatisticsBreakdown: string
{
    case NONE = 'none';
    case BROWSER = 'browser';
    case PLATFORM = 'platform';
    case USER_AGENT = 'user_agent';
    case REFERRER = 'referrer';
    case COUNTRY = 'country';
    case STATUS_CODE = 'status_code';
    case URL = 'url';
    case FQDN = 'fqdn';
    case DOMAIN = 'domain';
    case FORWARD = 'forward';
    case RULE = 'rule';
}
