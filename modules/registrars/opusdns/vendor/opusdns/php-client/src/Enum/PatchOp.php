<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

enum PatchOp: string
{
    case UPSERT = 'upsert';
    case REMOVE = 'remove';
}
