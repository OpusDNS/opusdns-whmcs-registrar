<?php

declare(strict_types=1);

namespace OpusDNS\Client\Exception;

/**
 * 401 Unauthorized, usually an invalid or missing API key.
 */
final class UnauthorizedException extends HttpException
{
}
