<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum RequestHistorySortField: string
{
    case METHOD = 'method';
    case PATH = 'path';
    case STATUS_CODE = 'status_code';
    case DURATION = 'duration';
    case SERVER_REQUEST_ID = 'server_request_id';
    case PERFORMED_BY_TYPE = 'performed_by_type';
    case PERFORMED_BY_ID = 'performed_by_id';
    case CREATED_ON = 'created_on';
    case REQUEST_STARTED_AT = 'request_started_at';
    case REQUEST_COMPLETED_AT = 'request_completed_at';
}
