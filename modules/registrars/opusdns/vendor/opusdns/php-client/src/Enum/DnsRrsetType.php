<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DnsRrsetType: string
{
    case A = 'A';
    case AAAA = 'AAAA';
    case ALIAS = 'ALIAS';
    case CAA = 'CAA';
    case CNAME = 'CNAME';
    case DNSKEY = 'DNSKEY';
    case DS = 'DS';
    case MX = 'MX';
    case NS = 'NS';
    case PTR = 'PTR';
    case TXT = 'TXT';
    case SOA = 'SOA';
    case SRV = 'SRV';
    case TLSA = 'TLSA';
    case SMIMEA = 'SMIMEA';
    case URI = 'URI';
    case HTTPS = 'HTTPS';
    case SVCB = 'SVCB';
    case NAPTR = 'NAPTR';
    case SSHFP = 'SSHFP';
    case CERT = 'CERT';
}
