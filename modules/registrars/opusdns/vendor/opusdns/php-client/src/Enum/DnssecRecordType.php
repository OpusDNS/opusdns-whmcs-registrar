<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum DnssecRecordType: string
{
    case DS_DATA = 'ds_data';
    case KEY_DATA = 'key_data';
}
