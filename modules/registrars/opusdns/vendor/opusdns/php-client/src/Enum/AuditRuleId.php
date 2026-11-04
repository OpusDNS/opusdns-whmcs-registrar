<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * A portfolio audit rule. New rules add values; for a value a client does not know, show the rule's
 * `title`.
 */
enum AuditRuleId: string
{
    case DNS_CNAME_AT_APEX = 'dns.cname_at_apex';
    case DNS_CNAME_CONFLICT = 'dns.cname_conflict';
    case DNS_DELEGATED_WITHOUT_ZONE = 'dns.delegated_without_zone';
    case MAIL_SPF_MULTIPLE = 'mail.spf_multiple';
    case MAIL_SPF_PASS_ALL = 'mail.spf_pass_all';
    case MAIL_MX_TARGET_IP = 'mail.mx_target_ip';
    case DOMAIN_EXPIRED = 'domain.expired';
    case DOMAIN_HOLD = 'domain.hold';
    case DOMAIN_PENDING_DELETE = 'domain.pending_delete';
    case MAIL_SPF_MISSING = 'mail.spf_missing';
    case MAIL_SPF_NEUTRAL_ALL = 'mail.spf_neutral_all';
    case MAIL_SPF_NO_ALL = 'mail.spf_no_all';
    case MAIL_DMARC_MISSING = 'mail.dmarc_missing';
    case MAIL_DMARC_MULTIPLE = 'mail.dmarc_multiple';
    case MAIL_DMARC_INVALID = 'mail.dmarc_invalid';
    case MAIL_MX_TARGET_CNAME = 'mail.mx_target_cname';
    case MAIL_NULL_MX_MIXED = 'mail.null_mx_mixed';
    case DOMAIN_EXPIRING_SOON = 'domain.expiring_soon';
    case DOMAIN_RENEWAL_OFF_EXPIRING = 'domain.renewal_off_expiring';
    case DOMAIN_TRANSFER_UNLOCKED = 'domain.transfer_unlocked';
    case DNS_SINGLE_NAMESERVER = 'dns.single_nameserver';
    case DNS_NS_DELEGATION_MISMATCH = 'dns.ns_delegation_mismatch';
    case DNS_ZONE_EMPTY = 'dns.zone_empty';
    case DNS_TTL_LOW = 'dns.ttl_low';
    case DNS_SPF_RR_TYPE = 'dns.spf_rr_type';
    case DNS_CAA_MISSING = 'dns.caa_missing';
    case MAIL_SPF_SOFTFAIL = 'mail.spf_softfail';
    case MAIL_DMARC_POLICY_NONE = 'mail.dmarc_policy_none';
    case MAIL_NO_MAIL_POLICY = 'mail.no_mail_policy';
    case DNS_DNSSEC_DISABLED = 'dns.dnssec_disabled';
    case SCAN_TLS_CERTIFICATE_INVALID = 'scan.tls_certificate_invalid';
    case SCAN_TLS_CERTIFICATE_EXPIRING = 'scan.tls_certificate_expiring';
    case SCAN_TLS_PROTOCOL_WEAK = 'scan.tls_protocol_weak';
    case SCAN_TLS_CHAIN_INCOMPLETE = 'scan.tls_chain_incomplete';
    case SCAN_SPF_LOOKUP_LIMIT = 'scan.spf_lookup_limit';
    case SCAN_DNSSEC_WEAK = 'scan.dnssec_weak';
    case SCAN_HSTS_MISSING = 'scan.hsts_missing';
    case SCAN_DNSSEC_UNSIGNED = 'scan.dnssec_unsigned';
}
