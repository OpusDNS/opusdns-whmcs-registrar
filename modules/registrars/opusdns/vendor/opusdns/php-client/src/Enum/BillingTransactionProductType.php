<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum BillingTransactionProductType: string
{
    case DOMAIN = 'domain';
    case ZONES = 'zones';
    case EMAIL_FORWARD = 'email_forward';
    case DOMAIN_FORWARD = 'domain_forward';
    case ACCOUNT_WALLET = 'account_wallet';
    case VANITY_NAMESERVER = 'vanity_nameserver';
    case WHITELABEL_BRANDING = 'whitelabel_branding';
    case WHITELABEL_BRANDING_PLUS = 'whitelabel_branding_plus';
    case RAS_DOMAIN_LIFECYCLE = 'ras_domain_lifecycle';
    case AMS_DOMAIN_LIFECYCLE = 'ams_domain_lifecycle';
}
