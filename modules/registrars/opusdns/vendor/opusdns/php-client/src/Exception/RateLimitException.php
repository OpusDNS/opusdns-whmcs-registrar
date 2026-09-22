<?php

declare(strict_types=1);

namespace OpusDNS\Client\Exception;

/**
 * 429 Too Many Requests.
 */
final class RateLimitException extends HttpException
{
    /**
     * Seconds to wait before retrying, from the Retry-After header, or null when the API did not send one.
     */
    public function retryAfter(): ?int
    {
        $header = trim($this->response->getHeaderLine('Retry-After'));
        if ($header === '') {
            return null;
        }
        if (ctype_digit($header)) {
            return (int) $header;
        }
        $retryAt = strtotime($header);
        if ($retryAt === false) {
            return null;
        }

        return max(0, $retryAt - time());
    }
}
