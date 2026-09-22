<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum PublicResource: string
{
    case ORGANIZATION = 'organization';
    case DOMAINS = 'domains';
    case DOMAIN_AUTH_CODES = 'domain_auth_codes';
    case CONTACTS = 'contacts';
    case DNS = 'dns';
    case HOSTS = 'hosts';
    case EMAIL_FORWARDS = 'email_forwards';
    case DOMAIN_FORWARDS = 'domain_forwards';
    case PARKING = 'parking';
    case EVENTS = 'events';
    case JOBS = 'jobs';
    case BILLING = 'billing';
    case USERS = 'users';
    case API_KEYS = 'api_keys';
    case REGISTRAR_CREDENTIALS = 'registrar_credentials';
    case TAGS = 'tags';
    case AUDIT_LOGS = 'audit_logs';
    case VANITY_NS = 'vanity_ns';
    case WHITELABEL_BRANDING = 'whitelabel_branding';
    case AI_CONCIERGE = 'ai_concierge';
}
