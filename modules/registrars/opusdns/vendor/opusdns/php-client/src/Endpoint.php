<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client;

/**
 * Path templates of every API endpoint. Placeholders are filled by Client::request().
 */
final class Endpoint
{
    /** GET */
    public const AI_CONCIERGE_CONTEXTS_BY_CONTEXT_ID = '/v1/ai-concierge/contexts/{context_id}';

    /** GET, POST */
    public const AI_CONCIERGE_CONVERSATIONS = '/v1/ai-concierge/conversations';

    /** GET, PATCH, DELETE */
    public const AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID = '/v1/ai-concierge/conversations/{conversation_id}';

    /** GET, POST */
    public const AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID_CONTEXTS = '/v1/ai-concierge/conversations/{conversation_id}/contexts';

    /** GET, POST */
    public const AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID_MESSAGES = '/v1/ai-concierge/conversations/{conversation_id}/messages';

    /** GET */
    public const AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID_MESSAGES_BY_MESSAGE_ID = '/v1/ai-concierge/conversations/{conversation_id}/messages/{message_id}';

    /** GET, POST */
    public const AI_CONCIERGE_MEMORY_FACTS = '/v1/ai-concierge/memory/facts';

    /** PATCH, DELETE */
    public const AI_CONCIERGE_MEMORY_FACTS_BY_FACT_ID = '/v1/ai-concierge/memory/facts/{fact_id}';

    /** GET */
    public const ARCHIVE_EMAIL_FORWARD_LOGS_ALIASES_BY_EMAIL_FORWARD_ALIAS_ID = '/v1/archive/email-forward-logs/aliases/{email_forward_alias_id}';

    /** GET */
    public const ARCHIVE_EMAIL_FORWARD_LOGS_BY_EMAIL_FORWARD_ID = '/v1/archive/email-forward-logs/{email_forward_id}';

    /** GET */
    public const ARCHIVE_OBJECT_LOGS = '/v1/archive/object-logs';

    /** GET */
    public const ARCHIVE_OBJECT_LOGS_BY_OBJECT_ID = '/v1/archive/object-logs/{object_id}';

    /** GET */
    public const ARCHIVE_REQUEST_HISTORY = '/v1/archive/request-history';

    /** GET */
    public const AUTH_CLIENT_CREDENTIALS_INTROSPECT = '/v1/auth/client_credentials/introspect';

    /** POST */
    public const AUTH_SIGNUP = '/v1/auth/signup';

    /** POST */
    public const AUTH_TOKEN = '/v1/auth/token';

    /** GET */
    public const AVAILABILITY = '/v1/availability';

    /** GET, POST */
    public const AVAILABILITY_STREAM = '/v1/availability/stream';

    /** GET, POST */
    public const CONTACTS = '/v1/contacts';

    /** GET, POST */
    public const CONTACTS_ATTRIBUTE_SETS = '/v1/contacts/attribute-sets';

    /** GET, PATCH, DELETE */
    public const CONTACTS_ATTRIBUTE_SETS_BY_CONTACT_ATTRIBUTE_SET_ID = '/v1/contacts/attribute-sets/{contact_attribute_set_id}';

    /** GET, PUT */
    public const CONTACTS_VERIFICATION = '/v1/contacts/verification';

    /** GET */
    public const CONTACTS_VERIFY = '/v1/contacts/verify';

    /** GET, DELETE */
    public const CONTACTS_BY_CONTACT_ID = '/v1/contacts/{contact_id}';

    /** PATCH */
    public const CONTACTS_BY_CONTACT_ID_LINK_BY_CONTACT_ATTRIBUTE_SET_ID = '/v1/contacts/{contact_id}/link/{contact_attribute_set_id}';

    /** GET, POST, PUT, DELETE */
    public const CONTACTS_BY_CONTACT_ID_VERIFICATION = '/v1/contacts/{contact_id}/verification';

    /** GET */
    public const CONTACTS_BY_CONTACT_ID_VERIFICATIONS = '/v1/contacts/{contact_id}/verifications';

    /** POST */
    public const CONTACTS_BY_CONTACT_ID_VERIFICATIONS_ATTEST = '/v1/contacts/{contact_id}/verifications/attest';

    /** GET, POST */
    public const DNS = '/v1/dns';

    /** GET */
    public const DNS_DOMAIN_FORWARDS = '/v1/dns/domain-forwards';

    /** GET */
    public const DNS_EMAIL_FORWARDS = '/v1/dns/email-forwards';

    /** GET */
    public const DNS_SUMMARY = '/v1/dns/summary';

    /** GET, DELETE */
    public const DNS_BY_ZONE_NAME = '/v1/dns/{zone_name}';

    /** POST */
    public const DNS_BY_ZONE_NAME_DNSSEC_DISABLE = '/v1/dns/{zone_name}/dnssec/disable';

    /** POST */
    public const DNS_BY_ZONE_NAME_DNSSEC_ENABLE = '/v1/dns/{zone_name}/dnssec/enable';

    /** GET */
    public const DNS_BY_ZONE_NAME_DOMAIN_FORWARDS = '/v1/dns/{zone_name}/domain-forwards';

    /** GET */
    public const DNS_BY_ZONE_NAME_EMAIL_FORWARDS = '/v1/dns/{zone_name}/email-forwards';

    /** PATCH */
    public const DNS_BY_ZONE_NAME_RECORDS = '/v1/dns/{zone_name}/records';

    /** PUT, PATCH */
    public const DNS_BY_ZONE_NAME_RRSETS = '/v1/dns/{zone_name}/rrsets';

    /** PATCH */
    public const DNS_BY_ZONE_NAME_VANITY_SET = '/v1/dns/{zone_name}/vanity-set';

    /** GET, POST, PATCH */
    public const DOMAIN_FORWARDS = '/v1/domain-forwards';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS = '/v1/domain-forwards/metrics';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS_BROWSER = '/v1/domain-forwards/metrics/browser';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS_GEO = '/v1/domain-forwards/metrics/geo';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS_PLATFORM = '/v1/domain-forwards/metrics/platform';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS_REFERRER = '/v1/domain-forwards/metrics/referrer';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS_STATUS_CODE = '/v1/domain-forwards/metrics/status-code';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS_TIME_SERIES = '/v1/domain-forwards/metrics/time-series';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS_USER_AGENT = '/v1/domain-forwards/metrics/user-agent';

    /** GET */
    public const DOMAIN_FORWARDS_METRICS_VISITS_BY_KEY = '/v1/domain-forwards/metrics/visits-by-key';

    /** GET, POST, DELETE */
    public const DOMAIN_FORWARDS_BY_HOSTNAME = '/v1/domain-forwards/{hostname}';

    /** PATCH */
    public const DOMAIN_FORWARDS_BY_HOSTNAME_DISABLE = '/v1/domain-forwards/{hostname}/disable';

    /** PATCH */
    public const DOMAIN_FORWARDS_BY_HOSTNAME_ENABLE = '/v1/domain-forwards/{hostname}/enable';

    /** GET, PUT, DELETE */
    public const DOMAIN_FORWARDS_BY_HOSTNAME_BY_PROTOCOL = '/v1/domain-forwards/{hostname}/{protocol}';

    /** GET */
    public const DOMAIN_SEARCH_SUGGEST = '/v1/domain-search/suggest';

    /** GET, POST */
    public const DOMAINS = '/v1/domains';

    /** GET */
    public const DOMAINS_CHECK = '/v1/domains/check';

    /** POST */
    public const DOMAINS_CLAIMS_NOTICES = '/v1/domains/claims-notices';

    /** GET */
    public const DOMAINS_STATISTICS = '/v1/domains/statistics';

    /** GET */
    public const DOMAINS_SUMMARY = '/v1/domains/summary';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_AT_BY_DOMAIN_REFERENCE_WITHDRAW = '/v1/domains/tld-specific/at/{domain_reference}/withdraw';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_BE_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/be/{domain_reference}/auth_code/request';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_CYMRU_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/cymru/{domain_reference}/auth_code/request';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_CZ_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/cz/{domain_reference}/auth_code/request';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_DE_BY_DOMAIN_REFERENCE_TRANSIT = '/v1/domains/tld-specific/de/{domain_reference}/transit';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_DK_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/dk/{domain_reference}/auth_code/request';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_EU_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/eu/{domain_reference}/auth_code/request';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_LT_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/lt/{domain_reference}/auth_code/request';

    /** GET, PUT */
    public const DOMAINS_TLD_SPECIFIC_NO_APPLICANT_DECLARATION = '/v1/domains/tld-specific/no/applicant-declaration';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_NO_BY_DOMAIN_REFERENCE_APPLICANT_DECLARATION = '/v1/domains/tld-specific/no/{domain_reference}/applicant-declaration';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_NO_BY_DOMAIN_REFERENCE_RESEND_DECLARATION_EMAIL = '/v1/domains/tld-specific/no/{domain_reference}/resend-declaration-email';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_NU_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/nu/{domain_reference}/auth_code/request';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_SE_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/se/{domain_reference}/auth_code/request';

    /** POST */
    public const DOMAINS_TLD_SPECIFIC_WALES_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST = '/v1/domains/tld-specific/wales/{domain_reference}/auth_code/request';

    /** POST */
    public const DOMAINS_TRANSFER = '/v1/domains/transfer';

    /** GET, PATCH, DELETE */
    public const DOMAINS_BY_DOMAIN_REFERENCE = '/v1/domains/{domain_reference}';

    /** GET, PUT, DELETE */
    public const DOMAINS_BY_DOMAIN_REFERENCE_DNSSEC = '/v1/domains/{domain_reference}/dnssec';

    /** POST */
    public const DOMAINS_BY_DOMAIN_REFERENCE_DNSSEC_DISABLE = '/v1/domains/{domain_reference}/dnssec/disable';

    /** POST */
    public const DOMAINS_BY_DOMAIN_REFERENCE_DNSSEC_ENABLE = '/v1/domains/{domain_reference}/dnssec/enable';

    /** POST */
    public const DOMAINS_BY_DOMAIN_REFERENCE_RENEW = '/v1/domains/{domain_reference}/renew';

    /** POST */
    public const DOMAINS_BY_DOMAIN_REFERENCE_RESTORE = '/v1/domains/{domain_reference}/restore';

    /** DELETE */
    public const DOMAINS_BY_DOMAIN_REFERENCE_TRANSFER = '/v1/domains/{domain_reference}/transfer';

    /** POST */
    public const DOMAINS_BY_DOMAIN_REFERENCE_TRANSFER_OUTBOUND = '/v1/domains/{domain_reference}/transfer/outbound';

    /** GET, POST */
    public const EMAIL_FORWARDS = '/v1/email-forwards';

    /** GET, DELETE */
    public const EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID = '/v1/email-forwards/{email_forward_id}';

    /** POST */
    public const EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_ALIASES = '/v1/email-forwards/{email_forward_id}/aliases';

    /** PUT, DELETE */
    public const EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_ALIASES_BY_ALIAS_ID = '/v1/email-forwards/{email_forward_id}/aliases/{alias_id}';

    /** PATCH */
    public const EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_DISABLE = '/v1/email-forwards/{email_forward_id}/disable';

    /** PATCH */
    public const EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_ENABLE = '/v1/email-forwards/{email_forward_id}/enable';

    /** GET */
    public const EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_METRICS = '/v1/email-forwards/{email_forward_id}/metrics';

    /** GET */
    public const EVENTS = '/v1/events';

    /** GET, PATCH */
    public const EVENTS_BY_EVENT_ID = '/v1/events/{event_id}';

    /** POST */
    public const HOSTS = '/v1/hosts';

    /** GET, PUT, DELETE */
    public const HOSTS_BY_HOST_REFERENCE = '/v1/hosts/{host_reference}';

    /** GET, DELETE */
    public const JOB_BY_JOB_ID = '/v1/job/{job_id}';

    /** POST */
    public const JOB_BY_JOB_ID_PAUSE = '/v1/job/{job_id}/pause';

    /** POST */
    public const JOB_BY_JOB_ID_RESUME = '/v1/job/{job_id}/resume';

    /** POST */
    public const JOB_BY_JOB_ID_RETRY = '/v1/job/{job_id}/retry';

    /** GET, POST */
    public const JOBS = '/v1/jobs';

    /** GET, DELETE */
    public const JOBS_BY_BATCH_ID = '/v1/jobs/{batch_id}';

    /** GET */
    public const JOBS_BY_BATCH_ID_JOBS = '/v1/jobs/{batch_id}/jobs';

    /** POST */
    public const JOBS_BY_BATCH_ID_PAUSE = '/v1/jobs/{batch_id}/pause';

    /** POST */
    public const JOBS_BY_BATCH_ID_RESUME = '/v1/jobs/{batch_id}/resume';

    /** POST */
    public const JOBS_BY_BATCH_ID_RETRY = '/v1/jobs/{batch_id}/retry';

    /** GET, POST */
    public const ORGANIZATIONS = '/v1/organizations';

    /** GET, PATCH */
    public const ORGANIZATIONS_ATTRIBUTES = '/v1/organizations/attributes';

    /** GET, POST */
    public const ORGANIZATIONS_IP_RESTRICTIONS = '/v1/organizations/ip-restrictions';

    /** GET, PATCH, DELETE */
    public const ORGANIZATIONS_IP_RESTRICTIONS_BY_IP_RESTRICTION_ID = '/v1/organizations/ip-restrictions/{ip_restriction_id}';

    /** GET */
    public const ORGANIZATIONS_ROLE_PERMISSIONS = '/v1/organizations/role-permissions';

    /** GET, POST */
    public const ORGANIZATIONS_ROLES = '/v1/organizations/roles';

    /** GET, PATCH, DELETE */
    public const ORGANIZATIONS_ROLES_BY_LABEL = '/v1/organizations/roles/{label}';

    /** GET */
    public const ORGANIZATIONS_USERS = '/v1/organizations/users';

    /** GET, PATCH, DELETE */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID = '/v1/organizations/{organization_id}';

    /** GET, PATCH */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID_ATTRIBUTES = '/v1/organizations/{organization_id}/attributes';

    /** GET */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID_BILLING_INVOICES = '/v1/organizations/{organization_id}/billing/invoices';

    /** GET */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID_BILLING_RECEIPTS = '/v1/organizations/{organization_id}/billing/receipts';

    /** GET */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID_PRICING_PRODUCT_TYPE_BY_PRODUCT_TYPE = '/v1/organizations/{organization_id}/pricing/product-type/{product_type}';

    /** GET */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID_TRANSACTIONS = '/v1/organizations/{organization_id}/transactions';

    /** GET */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID_TRANSACTIONS_BY_TRANSACTION_ID = '/v1/organizations/{organization_id}/transactions/{transaction_id}';

    /** GET */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID_USAGE_BY_PRODUCT = '/v1/organizations/{organization_id}/usage/{product}';

    /** GET */
    public const ORGANIZATIONS_BY_ORGANIZATION_ID_USAGE_BY_PRODUCT_SUMMARY = '/v1/organizations/{organization_id}/usage/{product}/summary';

    /** GET */
    public const PARKING = '/v1/parking';

    /** GET */
    public const PARKING_METRICS = '/v1/parking/metrics';

    /** POST */
    public const PARKING_SIGNUP = '/v1/parking/signup';

    /** GET */
    public const PARKING_SIGNUP_STATUS = '/v1/parking/signup/status';

    /** GET */
    public const PARKING_BY_PARKING_REFERENCE_METRICS = '/v1/parking/{parking_reference}/metrics';

    /** GET, POST */
    public const REPORTS = '/v1/reports';

    /** GET */
    public const REPORTS_BY_REPORT_ID = '/v1/reports/{report_id}';

    /** GET */
    public const REPORTS_BY_REPORT_ID_DOWNLOAD = '/v1/reports/{report_id}/download';

    /** GET, POST */
    public const TAGS = '/v1/tags';

    /** POST */
    public const TAGS_OBJECTS = '/v1/tags/objects';

    /** GET, PATCH, DELETE */
    public const TAGS_BY_TAG_ID = '/v1/tags/{tag_id}';

    /** POST */
    public const TAGS_BY_TAG_ID_OBJECTS = '/v1/tags/{tag_id}/objects';

    /** GET */
    public const TLDS = '/v1/tlds/';

    /** GET */
    public const TLDS_PORTFOLIO = '/v1/tlds/portfolio';

    /** GET */
    public const TLDS_BY_TLD = '/v1/tlds/{tld}';

    /** POST */
    public const USERS = '/v1/users';

    /** GET */
    public const USERS_ME = '/v1/users/me';

    /** GET, PATCH, DELETE */
    public const USERS_BY_USER_ID = '/v1/users/{user_id}';

    /** GET */
    public const USERS_BY_USER_ID_PERMISSIONS = '/v1/users/{user_id}/permissions';

    /** GET, PUT */
    public const USERS_BY_USER_ID_ROLE = '/v1/users/{user_id}/role';

    /** GET, POST */
    public const VANITY_NAMESERVER_SETS = '/v1/vanity-nameserver-sets';

    /** POST */
    public const VANITY_NAMESERVER_SETS_CHECK = '/v1/vanity-nameserver-sets/check';

    /** DELETE */
    public const VANITY_NAMESERVER_SETS_DEFAULT = '/v1/vanity-nameserver-sets/default';

    /** GET, PATCH, DELETE */
    public const VANITY_NAMESERVER_SETS_BY_SET_ID = '/v1/vanity-nameserver-sets/{set_id}';

    /** PATCH */
    public const VANITY_NAMESERVER_SETS_BY_SET_ID_DEFAULT = '/v1/vanity-nameserver-sets/{set_id}/default';

    /** POST */
    public const VANITY_NAMESERVER_SETS_BY_SET_ID_RESTORE = '/v1/vanity-nameserver-sets/{set_id}/restore';

    /** POST */
    public const VANITY_NAMESERVER_SETS_BY_SET_ID_RETRY = '/v1/vanity-nameserver-sets/{set_id}/retry';

    /** GET */
    public const VANITY_NAMESERVER_SETS_BY_SET_ID_ZONES = '/v1/vanity-nameserver-sets/{set_id}/zones';

    /** GET, POST, PATCH */
    public const WHITELABEL_BRANDING = '/v1/whitelabel-branding';

    /** GET, POST */
    public const WHITELABEL_BRANDING_ASSETS = '/v1/whitelabel-branding/assets';

    /** DELETE */
    public const WHITELABEL_BRANDING_ASSETS_BY_ASSET_ID = '/v1/whitelabel-branding/assets/{asset_id}';

    /** GET, POST, PUT */
    public const WHITELABEL_BRANDING_DOCUMENT = '/v1/whitelabel-branding/document';

    /** POST */
    public const WHITELABEL_BRANDING_EMAIL_PREVIEW = '/v1/whitelabel-branding/email/preview';

    /** GET */
    public const WHITELABEL_BRANDING_EMAIL_TEMPLATES = '/v1/whitelabel-branding/email/templates';

    /** POST */
    public const WHITELABEL_BRANDING_RECHECK = '/v1/whitelabel-branding/recheck';

    /** POST */
    public const WHITELABEL_BRANDING_RESTORE = '/v1/whitelabel-branding/restore';

    /** POST */
    public const WHITELABEL_BRANDING_TIER = '/v1/whitelabel-branding/tier';
}
