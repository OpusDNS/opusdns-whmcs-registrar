<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Model\CommonModelsAvailabilityDatasourceDomainAvailabilityResponse;
use OpusDNS\Client\Model\DomainAvailabilityRequest;

/**
 * Operations tagged "availability".
 */
final class AvailabilityService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Check domain availability
     *
     * Check the availability of one or more domains. Invalid domains are reported per domain (status
     * 'error' with error details) instead of failing the whole request.
     *
     * @param list<string> $domains Specify one or more domains to check for availability.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function bulkAvailability(
        array $domains,
        ?string $xDatetimeFormat = null,
    ): CommonModelsAvailabilityDatasourceDomainAvailabilityResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::AVAILABILITY,
            query: ['domains' => $domains],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): CommonModelsAvailabilityDatasourceDomainAvailabilityResponse => CommonModelsAvailabilityDatasourceDomainAvailabilityResponse::fromArray($data));
    }

    /**
     * Stream domain availability results
     *
     * Stream domain availability results using Server-Sent Events (SSE) until the `done` event is
     * received.
     *
     * @param list<string> $domains Specify one or more domains to check for availability.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     * @deprecated
     */
    public function streamAvailability(
        array $domains,
        ?string $xDatetimeFormat = null,
    ): \Psr\Http\Message\StreamInterface {
        $response = $this->client->request(
            'GET',
            Endpoint::AVAILABILITY_STREAM,
            query: ['domains' => $domains],
            headers: ['X-Datetime-Format' => $xDatetimeFormat, 'Accept' => 'text/event-stream'],
        );

        return $response->getBody();
    }

    /**
     * Stream domain availability results
     *
     * Stream domain availability results using Server-Sent Events (SSE) until the `done` event is
     * received.
     *
     * @param DomainAvailabilityRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function streamAvailabilityPost(
        DomainAvailabilityRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): \Psr\Http\Message\StreamInterface {
        $response = $this->client->request(
            'POST',
            Endpoint::AVAILABILITY_STREAM,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat, 'Accept' => 'text/event-stream'],
        );

        return $response->getBody();
    }
}
