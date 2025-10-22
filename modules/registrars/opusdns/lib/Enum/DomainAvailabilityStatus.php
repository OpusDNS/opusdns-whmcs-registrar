<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum DomainAvailabilityStatus: string
{
    case AVAILABLE = 'available';
    case UNAVAILABLE = 'unavailable';
    case MARKET_AVAILABLE = 'market_available';
    case TMCH_CLAIM = 'tmch_claim';
    case ERROR = 'error';
}
