<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ObjectEventType: string
{
    case CREATED = 'CREATED';
    case UPDATED = 'UPDATED';
    case DELETED = 'DELETED';
    case IMPORTED = 'IMPORTED';
    case TRANSFER_STARTED = 'TRANSFER_STARTED';
    case TRANSFER_COMPLETED = 'TRANSFER_COMPLETED';
    case TRANSFER_OUT_STARTED = 'TRANSFER_OUT_STARTED';
    case TRANSFER_OUT_COMPLETED = 'TRANSFER_OUT_COMPLETED';
    case RENEWED = 'RENEWED';
    case RESTORED = 'RESTORED';
    case BILLING_TRANSACTION_RESERVED = 'BILLING_TRANSACTION_RESERVED';
    case BILLING_TRANSACTION_SUCCEEDED = 'BILLING_TRANSACTION_SUCCEEDED';
    case BILLING_TRANSACTION_FAILED = 'BILLING_TRANSACTION_FAILED';
    case BILLING_TRANSACTION_CANCELLED = 'BILLING_TRANSACTION_CANCELLED';
}
