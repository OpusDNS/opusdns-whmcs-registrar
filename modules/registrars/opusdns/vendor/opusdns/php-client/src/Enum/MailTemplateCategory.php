<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Category a template is grouped under in the editor. An unrecognised value decodes to `unknown`.
 */
enum MailTemplateCategory: string
{
    case ORGANIZATION = 'organization';
    case BILLING = 'billing';
    case USER_ACCOUNT = 'user_account';
    case ICANN_POLICY = 'icann_policy';
    case TLD_SPECIFIC = 'tld_specific';
    case UNKNOWN = 'unknown';
}
