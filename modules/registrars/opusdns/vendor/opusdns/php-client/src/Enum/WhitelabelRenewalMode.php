<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Whether the whitelabel's subscription auto-renews (RENEW) or lapses at period end (EXPIRE, i.e.
 * cancelled). The customer's renewal intent, stored on the row and mirrored to the subscription on
 * change (like the domain object). Its own enum so the whitelabel model does not depend on the domain
 * model; the wire values (renew/expire) match domains + vanity nameservers.
 */
enum WhitelabelRenewalMode: string
{
    case RENEW = 'renew';
    case EXPIRE = 'expire';
}
