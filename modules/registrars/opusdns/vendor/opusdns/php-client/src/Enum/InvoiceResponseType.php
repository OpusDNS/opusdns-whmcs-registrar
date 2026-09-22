<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum InvoiceResponseType: string
{
    case SUBSCRIPTION = 'subscription';
    case ADD_ON = 'add_on';
    case CREDIT = 'credit';
    case ONE_OFF = 'one_off';
    case ADVANCE_CHARGES = 'advance_charges';
    case PROGRESSIVE_BILLING = 'progressive_billing';
}
