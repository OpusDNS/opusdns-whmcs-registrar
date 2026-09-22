<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum EmailForwardLogSortField: string
{
    case LOG_ID = 'log_id';
    case SENDER_EMAIL = 'sender_email';
    case RECIPIENT_EMAIL = 'recipient_email';
    case FORWARD_EMAIL = 'forward_email';
    case FINAL_STATUS = 'final_status';
    case CREATED_ON = 'created_on';
    case SYNCED_ON = 'synced_on';
}
