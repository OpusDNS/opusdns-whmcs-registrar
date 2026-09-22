<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Fate of the DS/DNSKEY submission that follows signing a zone.
 *
 * DEFERRED means the zone is signed but the parent holds no DS yet: the registry rejected the
 * submission because the public nameservers had not served the new key material yet, and a background
 * job is retrying. A signed zone with no DS at the parent resolves as unsigned, so the intermediate
 * state is safe.
 *
 * WITHDRAWN means the zone stopped being signed while the DS was in flight, so the DS was taken back
 * off the parent: the enablement did not take effect. It is kept apart from SKIPPED because SKIPPED
 * also covers "there was nothing to submit", and a caller must not render an enablement that was
 * undone as a success.
 *
 * FAILED means the zone is signed and nothing is working towards a DS. Only the zone create path can
 * report it, because that is the one caller that cannot propagate the error. Null means the response
 * makes no statement about a registry DS submission.
 */
enum DnssecRegistryPublishOutcome: string
{
    case PUBLISHED = 'published';
    case DEFERRED = 'deferred';
    case SKIPPED = 'skipped';
    case WITHDRAWN = 'withdrawn';
    case FAILED = 'failed';
}
