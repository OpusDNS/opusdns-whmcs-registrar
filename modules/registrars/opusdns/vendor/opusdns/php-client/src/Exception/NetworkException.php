<?php

declare(strict_types=1);

namespace OpusDNS\Client\Exception;

/**
 * The request never produced a response: DNS, TLS, connection or timeout failures.
 */
final class NetworkException extends OpusDnsException
{
}
