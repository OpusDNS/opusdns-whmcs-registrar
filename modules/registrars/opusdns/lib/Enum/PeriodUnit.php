<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum PeriodUnit: string
{
    case YEAR = 'y';
    case MONTH = 'm';
    case DAY = 'd';
}
