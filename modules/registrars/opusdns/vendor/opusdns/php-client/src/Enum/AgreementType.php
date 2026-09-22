<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum AgreementType: string
{
    case TERMS_AND_CONDITIONS = 'terms_and_conditions';
    case MASTER_SERVICE_AGREEMENT = 'master_service_agreement';
    case ACTING_AS_TRADER = 'acting_as_trader';
    case PARKING_AGREEMENT = 'parking_agreement';
}
