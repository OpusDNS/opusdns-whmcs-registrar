<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * HTTP methods and descriptions
 *
 * Methods from the following RFCs are all observed:
 *
 * * RFC 9110: HTTP Semantics, obsoletes 7231, which obsoleted 2616 * RFC 5789: PATCH Method for HTTP
 */
enum HTTPMethod: string
{
    case CONNECT = 'CONNECT';
    case DELETE = 'DELETE';
    case GET = 'GET';
    case HEAD = 'HEAD';
    case OPTIONS = 'OPTIONS';
    case PATCH = 'PATCH';
    case POST = 'POST';
    case PUT = 'PUT';
    case TRACE = 'TRACE';
}
