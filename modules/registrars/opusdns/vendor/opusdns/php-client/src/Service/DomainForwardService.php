<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\DomainForwardSortField;
use OpusDNS\Client\Enum\HttpProtocol;
use OpusDNS\Client\Enum\MetricsGrouping;
use OpusDNS\Client\Enum\Protocol;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Enum\TimeRange;
use OpusDNS\Client\Model\DomainForward;
use OpusDNS\Client\Model\DomainForwardBrowserStatsResponse;
use OpusDNS\Client\Model\DomainForwardCreateRequest;
use OpusDNS\Client\Model\DomainForwardGeoStatsResponse;
use OpusDNS\Client\Model\DomainForwardMetricsResponse;
use OpusDNS\Client\Model\DomainForwardMetricsTimeSeriesResponse;
use OpusDNS\Client\Model\DomainForwardPatchOps;
use OpusDNS\Client\Model\DomainForwardPlatformStatsResponse;
use OpusDNS\Client\Model\DomainForwardReferrerStatsResponse;
use OpusDNS\Client\Model\DomainForwardSetCreateRequest;
use OpusDNS\Client\Model\DomainForwardSetRequest;
use OpusDNS\Client\Model\DomainForwardSetResponse;
use OpusDNS\Client\Model\DomainForwardStatusCodeStatsResponse;
use OpusDNS\Client\Model\DomainForwardUserAgentStatsResponse;
use OpusDNS\Client\Model\DomainForwardVisitsByKeyResponse;
use OpusDNS\Client\Model\PaginationDomainForward;

/**
 * Operations tagged "domain_forward".
 */
final class DomainForwardService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List domain forwards
     *
     * Retrieves a paginated list of domain forwards by hostname for the organization
     *
     * Required permissions: domain_forwards:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param DomainForwardSortField|string|null $sortBy Server default: created_on.
     * @param SortOrder|string|null $sortOrder Server default: desc.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listDomainForwards(
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        DomainForwardSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $xDatetimeFormat = null,
    ): PaginationDomainForward {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS,
            query: ['page' => $page, 'page_size' => $pageSize, 'search' => $search, 'sort_by' => $sortBy, 'sort_order' => $sortOrder],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationDomainForward => PaginationDomainForward::fromArray($data));
    }

    /**
     * Create a domain forward
     *
     * Creates a new domain forward configuration. Wildcard forwards can be created by using *.hostname
     * (e.g., *.example.com).
     *
     * Required permissions: domain_forwards:manage
     *
     * @param DomainForwardCreateRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createDomainForwardV2(
        DomainForwardCreateRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): DomainForward {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAIN_FORWARDS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForward => DomainForward::fromArray($data));
    }

    /**
     * Patch domain forward redirects
     *
     * Applies patch operations to update or remove redirects across hostnames and protocols. Raises an
     * error if the domain forward or domain forward set does not exist.
     *
     * Required permissions: domain_forwards:manage
     *
     * @param DomainForwardPatchOps|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function patchRedirects(DomainForwardPatchOps|array $body, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'PATCH',
            Endpoint::DOMAIN_FORWARDS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Get domain forward metrics
     *
     * Retrieves overall metrics for domain forwards including total and unique visit counts.
     *
     * Required permissions: domain_forwards:read
     *
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function metrics(
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardMetricsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS,
            query: ['hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardMetricsResponse => DomainForwardMetricsResponse::fromArray($data));
    }

    /**
     * Get browser statistics
     *
     * Retrieves visitor traffic broken down by browser type (Chrome, Safari, Firefox, etc.) with total and
     * unique visit counts.
     *
     * Required permissions: domain_forwards:read
     *
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function browserStats(
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardBrowserStatsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS_BROWSER,
            query: ['hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardBrowserStatsResponse => DomainForwardBrowserStatsResponse::fromArray($data));
    }

    /**
     * Get geographic statistics
     *
     * Retrieves visitor traffic broken down by geographic location (country code) with visit counts.
     *
     * Required permissions: domain_forwards:read
     *
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function geoStats(
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardGeoStatsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS_GEO,
            query: ['hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardGeoStatsResponse => DomainForwardGeoStatsResponse::fromArray($data));
    }

    /**
     * Get platform statistics
     *
     * Retrieves visitor traffic broken down by platform (Windows, Macintosh, iOS, Android, Linux) with
     * total and unique visit counts.
     *
     * Required permissions: domain_forwards:read
     *
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function platformStats(
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardPlatformStatsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS_PLATFORM,
            query: ['hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardPlatformStatsResponse => DomainForwardPlatformStatsResponse::fromArray($data));
    }

    /**
     * Get referrer statistics
     *
     * Retrieves visitor referral sources (where traffic came from) with total and unique visit counts.
     *
     * Required permissions: domain_forwards:read
     *
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function referrerStats(
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardReferrerStatsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS_REFERRER,
            query: ['hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardReferrerStatsResponse => DomainForwardReferrerStatsResponse::fromArray($data));
    }

    /**
     * Get HTTP status code statistics
     *
     * Retrieves distribution of HTTP redirect status codes (301, 302, 307, 308) used across forwards.
     *
     * Required permissions: domain_forwards:read
     *
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function statusCodeStats(
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardStatusCodeStatsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS_STATUS_CODE,
            query: ['hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardStatusCodeStatsResponse => DomainForwardStatusCodeStatsResponse::fromArray($data));
    }

    /**
     * Get domain forward time series metrics
     *
     * Retrieves visit counts bucketed by time intervals (hourly, daily) for the specified time range.
     *
     * Required permissions: domain_forwards:read
     *
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function timeSeries(
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardMetricsTimeSeriesResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS_TIME_SERIES,
            query: ['hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardMetricsTimeSeriesResponse => DomainForwardMetricsTimeSeriesResponse::fromArray($data));
    }

    /**
     * Get user agent statistics
     *
     * Retrieves visitor traffic broken down by user agent string with total and unique visit counts.
     *
     * Required permissions: domain_forwards:read
     *
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function userAgentStats(
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardUserAgentStatsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS_USER_AGENT,
            query: ['hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardUserAgentStatsResponse => DomainForwardUserAgentStatsResponse::fromArray($data));
    }

    /**
     * Get visits grouped by key
     *
     * Retrieves visit metrics grouped by a specified key (url, fqdn, domain, forward, or rule) with total
     * and unique visit counts.
     *
     * Required permissions: domain_forwards:read
     *
     * @param MetricsGrouping|string|null $grouping Grouping key: url, fqdn, domain, forward, or rule Server default:
     *     domain.
     * @param Protocol|string|null $protocol Filter by protocol: http or https
     * @param TimeRange|string|null $timeRange Time range: 1h, 1d, 7d, 30d, or 1y Server default: 1d.
     * @param bool|null $excludeBots Exclude platform values: Unknown, Bot Server default: false.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function visitsByKey(
        MetricsGrouping|string|null $grouping = null,
        ?string $hostname = null,
        ?string $domain = null,
        Protocol|string|null $protocol = null,
        TimeRange|string|null $timeRange = null,
        ?bool $excludeBots = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardVisitsByKeyResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_METRICS_VISITS_BY_KEY,
            query: ['grouping' => $grouping, 'hostname' => $hostname, 'domain' => $domain, 'protocol' => $protocol, 'time_range' => $timeRange, 'exclude_bots' => $excludeBots],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardVisitsByKeyResponse => DomainForwardVisitsByKeyResponse::fromArray($data));
    }

    /**
     * Get a domain forward
     *
     * Retrieves the domain forward configuration for the specified hostname
     *
     * Required permissions: domain_forwards:read
     *
     * @param string $hostname Hostname
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getDomainForward(string $hostname, ?string $xDatetimeFormat = null): DomainForward
    {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_BY_HOSTNAME,
            path: ['hostname' => $hostname],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForward => DomainForward::fromArray($data));
    }

    /**
     * Create domain forward set
     *
     * Creates a new domain forward set for a specific protocol (HTTP or HTTPS). Raises an error if the set
     * already exists.
     *
     * Required permissions: domain_forwards:manage
     *
     * @param string $hostname Hostname
     * @param DomainForwardSetCreateRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createDomainForwardSet(
        string $hostname,
        DomainForwardSetCreateRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): DomainForwardSetResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAIN_FORWARDS_BY_HOSTNAME,
            path: ['hostname' => $hostname],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardSetResponse => DomainForwardSetResponse::fromArray($data));
    }

    /**
     * Delete a domain forward
     *
     * Deletes the domain forward configuration for the specified hostname
     *
     * Required permissions: domain_forwards:delete
     *
     * @param string $hostname Hostname
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteDomainForward(string $hostname, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::DOMAIN_FORWARDS_BY_HOSTNAME,
            path: ['hostname' => $hostname],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Disable domain forward
     *
     * Disables domain forwarding by removing DNS records. The domain forward configuration is preserved
     * but disabled.
     *
     * Required permissions: domain_forwards:manage
     *
     * @param string $hostname Hostname
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function disableDomainForward(string $hostname, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'PATCH',
            Endpoint::DOMAIN_FORWARDS_BY_HOSTNAME_DISABLE,
            path: ['hostname' => $hostname],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Enable domain forward
     *
     * Enables domain forwarding by creating necessary DNS records
     *
     * Required permissions: domain_forwards:manage
     *
     * @param string $hostname Hostname
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function enableDomainForward(string $hostname, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'PATCH',
            Endpoint::DOMAIN_FORWARDS_BY_HOSTNAME_ENABLE,
            path: ['hostname' => $hostname],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Get domain forward set
     *
     * Retrieves all redirects for a specific protocol (HTTP or HTTPS) for the specified hostname
     *
     * Required permissions: domain_forwards:read
     *
     * @param string $hostname Hostname
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getDomainForwardSet(
        HttpProtocol|string $protocol,
        string $hostname,
        ?string $xDatetimeFormat = null,
    ): DomainForwardSetResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_BY_HOSTNAME_BY_PROTOCOL,
            path: ['protocol' => $protocol, 'hostname' => $hostname],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardSetResponse => DomainForwardSetResponse::fromArray($data));
    }

    /**
     * Update domain forward set
     *
     * Updates an existing domain forward set for a specific protocol (HTTP or HTTPS). All existing
     * redirects for this protocol are replaced with the provided redirects. Raises an error if the set
     * does not exist.
     *
     * Required permissions: domain_forwards:manage
     *
     * @param string $hostname Hostname
     * @param DomainForwardSetRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function updateDomainForwardSet(
        HttpProtocol|string $protocol,
        string $hostname,
        DomainForwardSetRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): DomainForwardSetResponse {
        $response = $this->client->request(
            'PUT',
            Endpoint::DOMAIN_FORWARDS_BY_HOSTNAME_BY_PROTOCOL,
            path: ['protocol' => $protocol, 'hostname' => $hostname],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardSetResponse => DomainForwardSetResponse::fromArray($data));
    }

    /**
     * Delete domain forward set
     *
     * Deletes a domain forward set for a specific protocol (HTTP or HTTPS).
     *
     * Required permissions: domain_forwards:delete
     *
     * @param string $hostname Hostname
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteDomainForwardSet(
        HttpProtocol|string $protocol,
        string $hostname,
        ?string $xDatetimeFormat = null,
    ): void {
        $this->client->request(
            'DELETE',
            Endpoint::DOMAIN_FORWARDS_BY_HOSTNAME_BY_PROTOCOL,
            path: ['protocol' => $protocol, 'hostname' => $hostname],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }
}
