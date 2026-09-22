<?php

declare(strict_types=1);

namespace OpusDNS\Client\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * The API answered with a 4xx or 5xx status. Problem details are exposed when the body carried them.
 */
class HttpException extends OpusDnsException
{
    /**
     * @param array<string, mixed> $body Decoded response body, empty when it was not a JSON object
     */
    public function __construct(
        string $message,
        public readonly RequestInterface $request,
        public readonly ResponseInterface $response,
        public readonly ?string $problemType = null,
        public readonly ?string $problemTitle = null,
        public readonly ?string $problemDetail = null,
        public readonly array $body = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $response->getStatusCode(), $previous);
    }

    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /** Builds the most specific exception for the status code. */
    public static function fromResponse(RequestInterface $request, ResponseInterface $response): self
    {
        $status = $response->getStatusCode();
        $body = self::decodeBody($response);

        $type = isset($body['type']) && is_string($body['type']) ? $body['type'] : null;
        $title = isset($body['title']) && is_string($body['title']) ? $body['title'] : null;
        $detail = null;
        if (isset($body['detail'])) {
            $detail = is_string($body['detail']) ? $body['detail'] : json_encode($body['detail']);
            $detail = $detail === false ? null : $detail;
        }

        $message = sprintf('HTTP %d for %s %s', $status, $request->getMethod(), $request->getUri());
        if ($title !== null) {
            $message .= ': ' . $title;
        }
        if ($detail !== null && $detail !== $title) {
            $message .= '. ' . $detail;
        }

        $class = match (true) {
            $status === 400 => BadRequestException::class,
            $status === 401 => UnauthorizedException::class,
            $status === 403 => ForbiddenException::class,
            $status === 404 => NotFoundException::class,
            $status === 409 => ConflictException::class,
            $status === 422 => ValidationException::class,
            $status === 429 => RateLimitException::class,
            $status >= 500 => ServerException::class,
            default => self::class,
        };

        return new $class($message, $request, $response, $type, $title, $detail, $body);
    }

    /** @return array<string, mixed> */
    private static function decodeBody(ResponseInterface $response): array
    {
        $raw = (string) $response->getBody();
        if (trim($raw) === '') {
            return [];
        }
        try {
            $decoded = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return [];
        }

        return is_array($decoded) && !array_is_list($decoded) ? $decoded : [];
    }
}
