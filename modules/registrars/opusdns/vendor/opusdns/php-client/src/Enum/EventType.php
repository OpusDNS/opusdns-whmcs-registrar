<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum EventType: string
{
    case REGISTRATION = 'REGISTRATION';
    case RENEWAL = 'RENEWAL';
    case MODIFICATION = 'MODIFICATION';
    case DELETION = 'DELETION';
    case INBOUND_TRANSFER = 'INBOUND_TRANSFER';
    case OUTBOUND_TRANSFER = 'OUTBOUND_TRANSFER';
    case TRANSIT = 'TRANSIT';
    case WITHDRAW = 'WITHDRAW';
    case VERIFICATION = 'VERIFICATION';
    case BALANCE = 'BALANCE';
    case VANITY_NS_PROVISION = 'VANITY_NS_PROVISION';
    case VANITY_NS_SUSPENSION = 'VANITY_NS_SUSPENSION';
    case VANITY_NS_RESTORATION = 'VANITY_NS_RESTORATION';
    case VANITY_NS_TERMINATION = 'VANITY_NS_TERMINATION';
    case CLONE = 'CLONE';
}
