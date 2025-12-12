<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum DnsRrsetType: string
{
    case A = 'A';
    case AAAA = 'AAAA';
    case CNAME = 'CNAME';
    case MX = 'MX';
    case TXT = 'TXT';
    case NS = 'NS';
    case SOA = 'SOA';
    case SRV = 'SRV';
    case CAA = 'CAA';
    case PTR = 'PTR';
    case DS = 'DS';
    case DNSKEY = 'DNSKEY';
}
