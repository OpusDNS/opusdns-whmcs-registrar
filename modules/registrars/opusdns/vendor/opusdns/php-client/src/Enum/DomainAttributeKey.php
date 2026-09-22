<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DomainAttributeKey: string
{
    case AUTO_RENEW_PERIOD = 'auto_renew_period';
    case MUSIC_REGISTRANT_ATTESTATION = 'music_registrant_attestation';
    case NIC_IT_COMPLIANCE_CONFIRMATION = 'nic_it_compliance_confirmation';
    case TRAVEL_INDUSTRY_ACKNOWLEDGEMENT = 'travel_industry_acknowledgement';
    case VERIFICATION_REQUIRED = 'verification_required';
    case DE_GENERAL_REQUEST_CONTACT = 'de_general_request_contact';
    case DE_ABUSE_CONTACT = 'de_abuse_contact';
    case NOR_ID_APPLICANT_VERSION = 'nor_id_applicant_version';
    case NOR_ID_APPLICANT_ACCEPT_NAME = 'nor_id_applicant_accept_name';
    case NOR_ID_APPLICANT_ACCEPT_DATE = 'nor_id_applicant_accept_date';
    case NOR_ID_DECLARATION = 'nor_id_declaration';
    case NOR_ID_DECLARATION_TOKEN = 'nor_id_declaration_token';
    case PUNKTUM_DK_TERMS_ACCEPTANCE = 'punktum_dk_terms_acceptance';
    case PUNKTUM_DK_TRACKING_NO = 'punktum_dk_tracking_no';
    case INTERNET_EE_REGISTRANT_AGREEMENT = 'internet_ee_registrant_agreement';
    case PROMOTION = 'promotion';
    case PROMOTION_ELIGIBILITY = 'promotion_eligibility';
    case DOMAIN_CONTACT_ATTRIBUTES = 'domain_contact_attributes';
    case REGISTRY_RESELLER_ID = 'registry_reseller_id';
}
