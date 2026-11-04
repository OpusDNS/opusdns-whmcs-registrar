<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum RegistrantChangeStatus: string
{
    case PENDING_CONFIRMATION = 'pending_confirmation';
    case CONFIRMED = 'confirmed';
    case EXECUTING = 'executing';
    case PENDING_REGISTRY = 'pending_registry';
    case PENDING_MANUAL = 'pending_manual';
    case COMPLETED = 'completed';
    case NOT_MATERIAL = 'not_material';
    case EXPIRED = 'expired';
    case CANCELED = 'canceled';
    case REJECTED = 'rejected';
    case FAILED = 'failed';
}
