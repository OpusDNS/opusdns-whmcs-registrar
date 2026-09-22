<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainStatus: string
{
    case OK = 'ok';
    case SERVER_TRANSFER_PROHIBITED = 'serverTransferProhibited';
    case SERVER_UPDATE_PROHIBITED = 'serverUpdateProhibited';
    case SERVER_DELETE_PROHIBITED = 'serverDeleteProhibited';
    case SERVER_RENEW_PROHIBITED = 'serverRenewProhibited';
    case SERVER_RESTORE_PROHIBITED = 'serverRestoreProhibited';
    case SERVER_HOLD = 'serverHold';
    case TRANSFER_PERIOD = 'transferPeriod';
    case RENEW_PERIOD = 'renewPeriod';
    case REDEMPTION_PERIOD = 'redemptionPeriod';
    case PENDING_UPDATE = 'pendingUpdate';
    case PENDING_TRANSFER = 'pendingTransfer';
    case PENDING_RESTORE = 'pendingRestore';
    case PENDING_RENEW = 'pendingRenew';
    case PENDING_DELETE = 'pendingDelete';
    case PENDING_CREATE = 'pendingCreate';
    case INACTIVE = 'inactive';
    case AUTO_RENEW_PERIOD = 'autoRenewPeriod';
    case ADD_PERIOD = 'addPeriod';
    case DELETED = 'deleted';
    case CLIENT_TRANSFER_PROHIBITED = 'clientTransferProhibited';
    case CLIENT_UPDATE_PROHIBITED = 'clientUpdateProhibited';
    case CLIENT_DELETE_PROHIBITED = 'clientDeleteProhibited';
    case CLIENT_RENEW_PROHIBITED = 'clientRenewProhibited';
    case CLIENT_HOLD = 'clientHold';
    case FREE = 'free';
    case CONNECT = 'connect';
    case FAILED = 'failed';
    case INVALID = 'invalid';
}
