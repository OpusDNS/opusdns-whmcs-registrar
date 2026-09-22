<?php

declare(strict_types=1);

namespace OpusDNS\Client\Exception;

/**
 * 403 Forbidden, the key lacks a required permission.
 */
final class ForbiddenException extends HttpException
{
}
