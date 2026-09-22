<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Model\HostCreate;
use OpusDNS\Client\Model\HostResponse;
use OpusDNS\Client\Model\HostUpdate;

/**
 * Operations tagged "host".
 */
final class HostService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Create a Host Object
     *
     * Create a new host object
     *
     * Required permissions: domains:manage, hosts:manage
     *
     * @param HostCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createHost(HostCreate|array $body, ?string $xDatetimeFormat = null): HostResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::HOSTS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): HostResponse => HostResponse::fromArray($data));
    }

    /**
     * Retrieve a Host Object
     *
     * Retrieves a host object by either its ID or hostname
     *
     * Required permissions: hosts:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getHost(string $hostReference, ?string $xDatetimeFormat = null): HostResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::HOSTS_BY_HOST_REFERENCE,
            path: ['host_reference' => $hostReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): HostResponse => HostResponse::fromArray($data));
    }

    /**
     * Update a Host Object
     *
     * Updates the IP addresses of a host object, referenced by either its ID or hostname
     *
     * Required permissions: hosts:manage
     *
     * @param HostUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function updateHost(
        string $hostReference,
        HostUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): HostResponse {
        $response = $this->client->request(
            'PUT',
            Endpoint::HOSTS_BY_HOST_REFERENCE,
            path: ['host_reference' => $hostReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): HostResponse => HostResponse::fromArray($data));
    }

    /**
     * Delete a Host Object
     *
     * Deletes a host object; only possible if the host is not in use
     *
     * Required permissions: hosts:delete
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteHost(string $hostReference, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::HOSTS_BY_HOST_REFERENCE,
            path: ['host_reference' => $hostReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }
}
