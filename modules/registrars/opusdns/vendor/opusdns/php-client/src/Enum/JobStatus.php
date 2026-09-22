<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum JobStatus: string
{
    case BLOCKED = 'blocked';
    case QUEUED = 'queued';
    case PAUSED = 'paused';
    case RUNNING = 'running';
    case SUCCEEDED = 'succeeded';
    case FAILED = 'failed';
    case CANCELED = 'canceled';
    case DEAD_LETTER = 'dead_letter';
}
