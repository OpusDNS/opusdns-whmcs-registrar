<?php

declare(strict_types=1);

namespace OpusDNS\Client;

use OpusDNS\Client\Exception\DecodingException;
use OpusDNS\Client\Exception\HttpException;
use OpusDNS\Client\Exception\NetworkException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use OpusDNS\Client\Service\ServiceAccessors;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Entry point of the client. Holds the HTTP layer and exposes one service per API tag, for example $client->dns().
 */
final class Client
{
    use ServiceAccessors;

    public const CONTENT_JSON = 'application/json';
    public const CONTENT_FORM = 'application/x-www-form-urlencoded';
    public const CONTENT_MULTIPART = 'multipart/form-data';

    public function __construct(
        private readonly Config $config,
        private readonly ClientInterface $http,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory,
    ) {
    }

    /**
     * Builds a client. Without explicit PSR-18 and PSR-17 implementations it uses Guzzle, which must then be installed.
     */
    public static function create(
        Config $config,
        ?ClientInterface $http = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ): self {
        if ($http === null || $requestFactory === null || $streamFactory === null) {
            if (!class_exists(\GuzzleHttp\Client::class) || !class_exists(\GuzzleHttp\Psr7\HttpFactory::class)) {
                throw new \LogicException('Install guzzlehttp/guzzle, or pass a PSR-18 client together with PSR-17 request and stream factories.');
            }
            $factory = new \GuzzleHttp\Psr7\HttpFactory();
            $http ??= new \GuzzleHttp\Client(['timeout' => $config->timeout, 'connect_timeout' => $config->connectTimeout]);
            $requestFactory ??= $factory;
            $streamFactory ??= $factory;
        }

        return new self($config, $http, $requestFactory, $streamFactory);
    }

    public function config(): Config
    {
        return $this->config;
    }

    /**
     * Sends a request and returns the raw response. Throws NetworkException when no response arrived and an
     * HttpException subclass for 4xx and 5xx statuses.
     *
     * @param string $endpoint Path template, see Endpoint
     * @param array<string, string|int|float|bool|\BackedEnum> $path Values for the template placeholders
     * @param array<string, mixed> $query Query parameters, see Serializer::query()
     * @param ApiModel|array<mixed>|null $body Request body, serialized according to $contentType
     * @param array<string, string|null> $headers Extra headers for this request; null values are skipped
     */
    public function request(
        string $method,
        string $endpoint,
        array $path = [],
        array $query = [],
        ApiModel|array|null $body = null,
        array $headers = [],
        string $contentType = self::CONTENT_JSON,
    ): ResponseInterface {
        $uri = $this->config->baseUrl . Serializer::path($endpoint, $path) . Serializer::query($query);
        $request = $this->requestFactory->createRequest($method, $uri)
            ->withHeader('Accept', self::CONTENT_JSON)
            ->withHeader('User-Agent', $this->config->userAgent)
            ->withHeader('X-Api-Key', $this->config->apiKey);

        if ($this->config->clientToken !== '') {
            $request = $request->withHeader('X-OpusDNS-Client', $this->config->clientToken);
        }
        foreach (array_merge($this->config->headers, $headers) as $name => $value) {
            if ($value !== null) {
                $request = $request->withHeader($name, $value);
            }
        }
        if ($body !== null) {
            [$payload, $type] = $this->encodeBody($body, $contentType);
            $request = $request
                ->withHeader('Content-Type', $type)
                ->withBody($this->streamFactory->createStream($payload));
        }

        try {
            $response = $this->http->sendRequest($request);
        } catch (ClientExceptionInterface $exception) {
            throw new NetworkException(sprintf('%s %s failed: %s', $method, $uri, $exception->getMessage()), 0, $exception);
        }

        if ($response->getStatusCode() >= 400) {
            throw HttpException::fromResponse($request->withoutHeader('X-Api-Key'), $response);
        }

        return $response;
    }

    /**
     * Decodes the JSON body and passes it to $hydrator; any failure while hydrating becomes a DecodingException.
     *
     * @template T
     * @param \Closure(array<mixed>): T $hydrator
     * @return ($optional is true ? T|null : T)
     */
    public function hydrate(ResponseInterface $response, \Closure $hydrator, bool $optional = false): mixed
    {
        $data = $this->decode($response);
        if ($data === null && $optional) {
            return null;
        }
        try {
            return $hydrator($data);
        } catch (\Throwable $exception) {
            throw new DecodingException('Failed to hydrate the response: ' . $exception->getMessage(), $response, $exception);
        }
    }

    /** Decodes a JSON body. Returns null when the body is empty. */
    public function decode(ResponseInterface $response): mixed
    {
        $raw = (string) $response->getBody();
        if (trim($raw) === '') {
            return null;
        }
        try {
            return json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            throw new DecodingException('Failed to decode the JSON response: ' . $exception->getMessage(), $response, $exception);
        }
    }

    /** @return array<string, mixed> */
    public function decodeArray(ResponseInterface $response): array
    {
        $data = $this->decode($response);
        if (!is_array($data)) {
            throw new DecodingException('Expected a JSON object in the response body, got ' . get_debug_type($data) . '.', $response);
        }

        return $data;
    }

    /** @return array<string, mixed>|null */
    public function decodeOptional(ResponseInterface $response): ?array
    {
        $data = $this->decode($response);
        if ($data !== null && !is_array($data)) {
            throw new DecodingException('Expected a JSON object or an empty body, got ' . get_debug_type($data) . '.', $response);
        }

        return $data;
    }

    /** @return list<mixed> */
    public function decodeList(ResponseInterface $response): array
    {
        $data = $this->decode($response);
        if (!is_array($data) || !array_is_list($data)) {
            throw new DecodingException('Expected a JSON array in the response body, got ' . get_debug_type($data) . '.', $response);
        }

        return $data;
    }

    /**
     * @param ApiModel|array<mixed> $body
     * @return array{string, string} Payload and Content-Type header value
     */
    private function encodeBody(ApiModel|array $body, string $contentType): array
    {
        $data = Serializer::normalize($body);
        if (!is_array($data)) {
            throw new \InvalidArgumentException('A request body must serialize to an array.');
        }

        return match ($contentType) {
            self::CONTENT_JSON => [
                $data === [] && $body instanceof ApiModel ? '{}' : json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                self::CONTENT_JSON,
            ],
            self::CONTENT_FORM => [http_build_query($data, '', '&', PHP_QUERY_RFC3986), self::CONTENT_FORM],
            self::CONTENT_MULTIPART => Serializer::multipart($data),
            default => throw new \InvalidArgumentException("Unsupported request content type: {$contentType}"),
        };
    }
}
