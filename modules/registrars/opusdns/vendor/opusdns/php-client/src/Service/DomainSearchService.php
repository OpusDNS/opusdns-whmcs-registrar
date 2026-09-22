<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Model\DomainSearchResponse;

/**
 * Operations tagged "domain_search".
 */
final class DomainSearchService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Suggest domains
     *
     * Get a list of domain suggestions based on a search query.
     *
     * Suggestions are generated and ranked by relevance rather than enumerated from a fixed list, so the
     * results depend on the shape of `query`:
     *
     * - **Keyword or phrase** (e.g. `bluewidgets`) — every result is a generated name, and its
     * `available` flag is best-effort. - **Full domain name** (e.g. `bluewidgets.de`) — the queried
     * domain is always returned as the first result, with availability checked directly against the
     * registry.
     *
     * Use a full domain name, or `GET /v1/availability`, whenever you need a definitive answer about a
     * specific domain.
     *
     * @param string $query The primary keyword or phrase for the domain search. A full domain name is always
     *     returned as the first result, with registry-checked availability.
     * @param list<string>|null $tlds Restricts results to these TLDs. This is a filter, not a guarantee: suggestions
     *     are ranked by relevance across the whole requested set, so a listed TLD may be absent from the results
     *     even when available names exist in it, and raising `limit` does not change that. To guarantee a TLD is
     *     represented, query it on its own.
     * @param int|null $limit The maximum number of domain suggestions to return
     * @param bool|null $premium Whether to include premium domains in the suggestions
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function suggest(
        string $query,
        ?array $tlds = null,
        ?int $limit = null,
        ?bool $premium = null,
        ?string $xDatetimeFormat = null,
    ): DomainSearchResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_SEARCH_SUGGEST,
            query: ['query' => $query, 'tlds' => $tlds, 'limit' => $limit, 'premium' => $premium],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainSearchResponse => DomainSearchResponse::fromArray($data));
    }
}
