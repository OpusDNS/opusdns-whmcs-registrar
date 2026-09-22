<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Includes a list endpoint offers.
 *
 * Deliberately narrower than `DomainIncludeField`: resolving a renewal price costs a registry check
 * plus a billing call per premium domain, which a page of results would multiply into a registry
 * rate-limit problem.
 *
 * Both the public list route and the internal domains-service list request implement every member.
 */
enum DomainListIncludeField: string
{
    case TAGS = 'tags';
    case REGISTRAR_CREDENTIAL = 'registrar_credential';
}
