<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum ObjectLogSortField: string
{
    case OBJECT_LOG_ID = 'object_log_id';
    case OBJECT_ID = 'object_id';
    case OBJECT_TYPE = 'object_type';
    case ACTION = 'action';
    case CREATED_ON = 'created_on';
    case SERVER_REQUEST_ID = 'server_request_id';
    case PERFORMED_BY_TYPE = 'performed_by_type';
    case PERFORMED_BY_ID = 'performed_by_id';
}
