<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ReportType: string
{
    case DOMAIN_INVENTORY = 'domain_inventory';
    case DNS_ZONE_SUMMARY = 'dns_zone_summary';
    case DNS_ZONE_RECORDS = 'dns_zone_records';
    case DOMAIN_FORWARDS = 'domain_forwards';
    case EXPIRING_DOMAINS = 'expiring_domains';
    case EMAIL_FORWARDS = 'email_forwards';
    case REGISTRAR_PORTFOLIO_PDF = 'registrar_portfolio_pdf';
    case BILLING_TRANSACTIONS = 'billing_transactions';
    case BILLING_TRANSACTIONS_MONTHLY = 'billing_transactions_monthly';
    case SUBORG_BILLING_TRANSACTIONS_MONTHLY = 'suborg_billing_transactions_monthly';
    case AGP_DELETIONS = 'agp_deletions';
}
