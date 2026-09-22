<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\RegistryServiceBackend;
use OpusDNS\Client\Model\TldResponseShort;
use OpusDNS\Client\Model\TldSpecificationResponse;

/**
 * Operations tagged "tld".
 */
final class TldService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Get list of Specifications for all TLDs we support
     *
     * Retrieves a list of TLD Specifications we have support for
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     * @return array<string, list<array<string, mixed>>>
     */
    public function getTldSpecifications(
        ?string $fields = null,
        ?string $tlds = null,
        ?string $xDatetimeFormat = null,
    ): array {
        $response = $this->client->request(
            'GET',
            Endpoint::TLDS,
            query: ['fields' => $fields, 'tlds' => $tlds],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->decodeArray($response);
    }

    /**
     * Get the list of TLDs we support
     *
     * Retrieves a list of TLDs we have support for
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     * @return list<TldResponseShort>
     */
    public function getTldPortfolio(?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'GET',
            Endpoint::TLDS_PORTFOLIO,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): TldResponseShort => TldResponseShort::fromArray($item), $data));
    }

    /**
     * Get the TLD specification
     *
     * Retrieves the TLD specification for a given TLD
     *
     * Required permissions: organization:read
     *
     * @param RegistryServiceBackend|string|null $backend Override the resolved account backend.
     * @param string|null $customerSpecRef Override the customer spec ref.
     * @param string|null $version Override the spec version pin (or LATEST).
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getTldSpec(
        string $tld,
        RegistryServiceBackend|string|null $backend = null,
        ?string $customerSpecRef = null,
        ?string $version = null,
        ?string $xDatetimeFormat = null,
    ): TldSpecificationResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::TLDS_BY_TLD,
            path: ['tld' => $tld],
            query: ['backend' => $backend, 'customer_spec_ref' => $customerSpecRef, 'version' => $version],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): TldSpecificationResponse => TldSpecificationResponse::fromArray($data));
    }
}
