<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainVerificationCloseReason: string
{
    case EVIDENCE_VERIFIED = 'EVIDENCE_VERIFIED';
    case REGISTRY_CLEARED = 'REGISTRY_CLEARED';
    case REGISTRY_REJECTED = 'REGISTRY_REJECTED';
    case SUPERSEDED = 'SUPERSEDED';
    case DOMAIN_DELETED = 'DOMAIN_DELETED';
    case TRANSFERRED_OUT = 'TRANSFERRED_OUT';
    case TRANSFER_ABORTED = 'TRANSFER_ABORTED';
}
