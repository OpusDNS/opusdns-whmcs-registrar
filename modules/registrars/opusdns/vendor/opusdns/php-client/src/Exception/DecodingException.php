<?php

declare(strict_types=1);

namespace OpusDNS\Client\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * A successful response carried a body the client could not interpret.
 */
final class DecodingException extends OpusDnsException
{
    public function __construct(string $message, public readonly ResponseInterface $response, ?\Throwable $previous = null)
    {
        parent::__construct($message, $response->getStatusCode(), $previous);
    }
}
