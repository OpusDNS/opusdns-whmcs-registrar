<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum DomainContactType: string
{
    case REGISTRANT = 'registrant';
    case ADMIN = 'admin';
    case TECH = 'tech';
    case BILLING = 'billing';
    
    public function getName(): string
    {
        return match ($this) {
            self::REGISTRANT => 'Registrant',
            self::ADMIN => 'Admin',
            self::TECH => 'Tech',
            self::BILLING => 'Billing',
        };
    }
    
    public function getDescription(): string
    {
        return match ($this) {
            self::REGISTRANT => 'The legal owner of the domain',
            self::ADMIN => 'Responsible for administrative tasks',
            self::TECH => 'Handles technical issues',
            self::BILLING => 'Responsible for billing and payments',
        };
    }
}
