<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum PremiumAffectsType: string
{
    case REGISTRATION = 'registration';
    case DELETE = 'delete';
    case RENEWAL = 'renewal';
    case UPDATE = 'update';
    case TRANSFER = 'transfer';
    case RESTORE = 'restore';
    case CUSTOM = 'custom';
}
