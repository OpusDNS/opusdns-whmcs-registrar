<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum AttributeType: string
{
    case ENUM = 'enum';
    case STRING = 'string';
    case BOOLEAN = 'boolean';
    case DATETIME = 'datetime';
    case INTEGER = 'integer';
    case COUNTRY_CODE = 'country_code';
    case URI_TEMPLATE = 'uri_template';
}
