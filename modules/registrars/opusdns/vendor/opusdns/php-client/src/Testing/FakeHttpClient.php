<?php

declare(strict_types=1);

namespace OpusDNS\Client\Testing;

use OpusDNS\Client\Client;
use OpusDNS\Client\Config;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * PSR-18 client for tests: records every request and answers from a queue of responses or exceptions.
 * An empty queue answers 200 with an empty JSON object.
 */
final class FakeHttpClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    public array $requests = [];

    /** @var list<ResponseInterface|\Throwable> */
    private array $queue = [];

    private readonly ResponseFactoryInterface $responseFactory;

    private readonly StreamFactoryInterface $streamFactory;

    private readonly RequestFactoryInterface $requestFactory;

    /**
     * Without PSR-17 factories, Guzzle's are used and guzzlehttp/guzzle must be installed.
     */
    public function __construct(
        ?ResponseFactoryInterface $responseFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
        ?RequestFactoryInterface $requestFactory = null,
    ) {
        if ($responseFactory === null || $streamFactory === null || $requestFactory === null) {
            if (!class_exists(\GuzzleHttp\Psr7\HttpFactory::class)) {
                throw new \LogicException('Install guzzlehttp/guzzle or pass PSR-17 response, stream and request factories.');
            }
            $factory = new \GuzzleHttp\Psr7\HttpFactory();
            $responseFactory ??= $factory;
            $streamFactory ??= $factory;
            $requestFactory ??= $factory;
        }
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
        $this->requestFactory = $requestFactory;
    }

    /** A Client that sends every request through this fake. */
    public function client(Config $config): Client
    {
        return new Client($config, $this, $this->requestFactory, $this->streamFactory);
    }

    public function queue(ResponseInterface|\Throwable $next): self
    {
        $this->queue[] = $next;

        return $this;
    }

    /**
     * Queues a JSON response. A null body queues an empty body, for example for a 204.
     *
     * @param array<string, string> $headers
     */
    public function queueJson(int $status, mixed $body, array $headers = []): self
    {
        $response = $this->responseFactory->createResponse($status);
        foreach ($headers + ['Content-Type' => 'application/json'] as $name => $value) {
            $response = $response->withHeader($name, $value);
        }
        if ($body !== null) {
            $response = $response->withBody($this->streamFactory->createStream(json_encode($body, JSON_THROW_ON_ERROR)));
        }

        return $this->queue($response);
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;
        $next = array_shift($this->queue);
        if ($next === null) {
            return $this->responseFactory->createResponse(200)
                ->withHeader('Content-Type', 'application/json')
                ->withBody($this->streamFactory->createStream('{}'));
        }
        if ($next instanceof \Throwable) {
            throw $next;
        }

        return $next;
    }

    public function lastRequest(): RequestInterface
    {
        $last = array_key_last($this->requests);
        if ($last === null) {
            throw new \LogicException('No request was sent.');
        }

        return $this->requests[$last];
    }
}
