<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\MarketplaceName;
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
     * With `marketplaces=fruits` (repeatable, or `marketplaces=all`), domains for sale on the marketplace
     * are added to `results`: the ones closest to `query` at a few places among the suggestions, never
     * before the first one, and the others after the suggestions. The suggestions themselves are unchanged
     * and keep their order. Marketplace items have `available: false` and `marketplace` set (`name`, the
     * marketplace the domain is for sale on). `price.amount` is the price to acquire the domain from the
     * marketplace, in the listing's currency, for a period of 1 year. It does not include a transfer: the
     * customer transfers the domain with the auth code, and that transfer is charged separately. When the
     * domain cannot be priced, `price.amount` is null. `renewal_price` is the TLD's standard renewal
     * price, and may be set on an unpriced item. `marketplace` is null on suggestions. A domain can appear
     * twice: as a suggestion with its registry fields, and as a marketplace item. `limit` and `tlds` apply
     * to the marketplace domains as well, with `limit` capping them separately from the suggestions; the
     * organization's TLD restriction and `premium` do not apply to them. `meta.total` counts all items in
     * `results`, both entries of a domain included. Marketplace domains are best-effort and left out when
     * the marketplace does not answer in time. They are only added for organizations billed in EUR; for
     * others `marketplaces` is ignored.
     *
     * @param string $query The primary keyword or phrase for the domain search. A full domain name is always
     *     returned as the first result, with registry-checked availability.
     * @param list<string>|null $tlds Restricts results to these TLDs. This is a filter, not a guarantee: suggestions
     *     are ranked by relevance across the whole requested set, so a listed TLD may be absent from the results
     *     even when available names exist in it, and raising `limit` does not change that. To guarantee a TLD is
     *     represented, query it on its own.
     * @param int|null $limit The maximum number of domain suggestions to return; with `marketplaces`, also caps the
     *     marketplace domains added to them
     * @param bool|null $premium Whether to include premium domains in the suggestions
     * @param list<string|MarketplaceName>|null $marketplaces Marketplaces to include domains for sale from, by name
     *     (repeatable), or `all` for every marketplace. Best-effort: marketplace domains may be missing.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function suggest(
        string $query,
        ?array $tlds = null,
        ?int $limit = null,
        ?bool $premium = null,
        ?array $marketplaces = null,
        ?string $xDatetimeFormat = null,
    ): DomainSearchResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_SEARCH_SUGGEST,
            query: ['query' => $query, 'tlds' => $tlds, 'limit' => $limit, 'premium' => $premium, 'marketplaces' => $marketplaces],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainSearchResponse => DomainSearchResponse::fromArray($data));
    }
}
