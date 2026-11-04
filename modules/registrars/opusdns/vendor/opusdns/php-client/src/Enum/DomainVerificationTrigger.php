<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainVerificationTrigger: string
{
    case CREATE = 'CREATE';
    case REGISTRANT_CHANGE = 'REGISTRANT_CHANGE';
    case TRANSFER = 'TRANSFER';
    case REGISTRY_REQUEST = 'REGISTRY_REQUEST';
    case BACKFILL = 'BACKFILL';
}
