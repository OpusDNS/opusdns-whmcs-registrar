<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainClientStatus: string
{
    case CLIENT_TRANSFER_PROHIBITED = 'clientTransferProhibited';
    case CLIENT_UPDATE_PROHIBITED = 'clientUpdateProhibited';
    case CLIENT_DELETE_PROHIBITED = 'clientDeleteProhibited';
    case CLIENT_RENEW_PROHIBITED = 'clientRenewProhibited';
    case CLIENT_HOLD = 'clientHold';
}
