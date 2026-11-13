<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\DomainForwardMoverDirection;
use OpusDNS\Client\Enum\DomainForwardMoversPeriod;
use OpusDNS\Client\Enum\DomainForwardSortField;
use OpusDNS\Client\Enum\DomainForwardStatisticsBreakdown;
use OpusDNS\Client\Enum\DomainForwardStatisticsGranularity;
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
use OpusDNS\Client\Model\DomainForwardMoversResponse;
use OpusDNS\Client\Model\DomainForwardPatchOps;
use OpusDNS\Client\Model\DomainForwardPlatformStatsResponse;
use OpusDNS\Client\Model\DomainForwardReferrerStatsResponse;
use OpusDNS\Client\Model\DomainForwardSetCreateRequest;
use OpusDNS\Client\Model\DomainForwardSetRequest;
use OpusDNS\Client\Model\DomainForwardSetResponse;
use OpusDNS\Client\Model\DomainForwardStatisticsResponse;
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
     * @param string|null $search Search by domain name (partial match), e.g. `example` finds forwards on
     *     `example.com`, `www.example.com` and `my-example.org`. Subdomains are not searched: `www` does not find
     *     `www.example.com`.
     * @param DomainForwardSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * Get domain forward statistics
     *
     * Counts the redirects your organization's domain forwards served in a window, as totals and as a
     * series of buckets, optionally with a top list (`breakdown`). It replaces the `/metrics` routes,
     * which will be deprecated.
     *
     * The window is `start_date` to `end_date`, both days inclusive (YYYY-MM-DD, UTC), and `granularity`
     * sets the bucket width: `hour`, `day`, `week` or `month`. The window may be at most 31 days for
     * `hour`, 366 days for `day` and `week`, and 25 calendar months for `month` long. Weeks start on
     * Monday and months on the 1st. With `granularity=hour` only, `start` and `end` (UTC instants, `end`
     * exclusive) may replace the two dates, for a rolling window such as the last 24 hours; give exactly
     * one of the two pairs. The response gives the window as days (`start_date`, `end_date`) and as
     * instants (`start`, `end`). Hourly counts are read in whole hours, so a time of day inside an hour
     * does not cut that hour, unless `hostname` or `protocol` is set: then the counts follow the exact
     * instants.
     *
     * Every bucket the window touches is present, oldest first. `period_start` and `period_end` are its
     * first and last day, both inclusive (an hourly bucket holds the day of its hour in both); `start` and
     * `end` are its instants, `end` exclusive. A bucket counts the days it shares with the window and with
     * `data_available_from`..`data_available_to`, from `covered_from` to `covered_to`, and holds 0 when
     * there was no redirect on them. A bucket that shares no time with the data holds null counts: no
     * data, rather than no redirects; the totals are null when the window has no data. A bucket marked
     * `partial` does not count its whole span: the window or the start of the data cuts it, or it reaches
     * `data_available_to` and is still filling. A bucket with null counts is partial too.
     *
     * Without a filter the counts cover all forwards of your organization, and with
     * `include_sub_organizations` its sub-organizations' too. `hostname` (one forward, exact) and `domain`
     * (a domain and all its subdomains) exclude each other and need view access to the zone.
     *
     * The window may start at most 35 days back at `hour`, and 25 months back at `day`, `week` and
     * `month`. With `hostname` or `protocol`, and for a top list by `user_agent`, `referrer`, `fqdn`,
     * `domain`, `forward` or `rule` with a `domain` filter, it may start at most 35 days back. A window
     * that starts earlier is rejected with 400. Top lists are kept for 13 months: over a window that
     * starts earlier, the top list counts only the last 13 months, while the buckets and totals reach
     * further back.
     *
     * `breakdown` is a list of rows, most redirects first; it is empty unless requested, and empty when
     * the totals are null. `breakdown_approximate` says whether the list may miss values or count them too
     * low. `url` lists host and path of the redirected requests (`www.example.com/shop`, no query string).
     * Request paths are kept for 13 months only as daily top lists: per domain and day, the 5 values with
     * the most hits, each with at least 3 hits that day. It therefore needs a `domain` filter, cannot be
     * combined with `hostname` or `protocol`, and sums the daily lists, so a path that did not make a
     * day's list is missing for that day. There is no list of URLs across all domains of an organization.
     * Asking for it without `domain`, or with `hostname` or `protocol`, is rejected with 422. Country data
     * is derived from IP addresses with GeoLite2 data created by MaxMind (https://www.maxmind.com).
     * Redirects without a referrer are grouped as `direct`.
     *
     * `unique_visits` and `invoked_forwards` are estimates (HyperLogLog), counted over the whole window
     * rather than added up from the buckets, so the unique visits of the buckets do not add up to the
     * total. `invoked_forwards` counts distinct forwards that served a redirect; the `/metrics` route
     * counts distinct domain and path pairs, so the two are not comparable. `configured_forwards` is the
     * number of redirect rules configured now, whatever the window, so `invoked_forwards` can exceed it.
     *
     * Redirects count for the organization that owned the forward when they happened: the traffic of a
     * deleted forward or domain, or of one moved to another organization, stays in the former owner's
     * totals, buckets and organization-wide top lists until retention ends, and the new owner sees only
     * the traffic since it owns the forward. `domain` and `hostname` filters work only for zones you
     * currently have.
     *
     * The route answers 501 where statistics are not available in this environment.
     *
     * Required permissions: domain_forwards:read
     *
     * @param string|null $hostname Only count redirects of this exact forward hostname. Excludes `domain`. Reaches
     *     back 35 days only, like `protocol`: a window starting earlier is rejected.
     * @param string|null $domain Only count redirects of this domain and all its subdomains. Excludes `hostname`.
     * @param \DateTimeImmutable|null $startDate First day of the window, inclusive (YYYY-MM-DD, UTC). Give
     *     `start_date` and `end_date`, or, with `granularity=hour` only, `start` and `end`.
     * @param \DateTimeImmutable|null $endDate Last day of the window, inclusive (YYYY-MM-DD, UTC). How far it may
     *     reach depends on `granularity`: at most 31 days for `hour`, 366 days for `day` and `week`, and 25 calendar
     *     months for `month`.
     * @param \DateTimeImmutable|null $start Start of the window as an instant, inclusive (RFC 3339; a value without
     *     an offset is read as UTC). Only with `granularity=hour`, instead of `start_date` and `end_date`, for a
     *     window such as the last 24 hours.
     * @param \DateTimeImmutable|null $end End of the window as an instant, exclusive (RFC 3339; a value without an
     *     offset is read as UTC). Only with `granularity=hour`, where it may be at most 31 days after `start`.
     * @param DomainForwardStatisticsGranularity|string|null $granularity Time-bucket size. Buckets start on the hour
     *     or the day (UTC); weeks start on Monday and months on the 1st. Server default: day.
     * @param HttpProtocol|string|null $protocol Only count redirects requested over this protocol. Reaches back 35
     *     days only, like `hostname`: a window starting earlier is rejected.
     * @param bool|null $excludeBots Leave out bots: redirects whose platform is `Bot` or `Unknown`, and crawlers
     *     that their user agent names (Googlebot, Applebot, Meta's crawlers and others) whatever platform they
     *     report. Redirects stored before November 2026 count by platform only, as the `/metrics` routes do. Server
     *     default: false.
     * @param bool|null $includeSubOrganizations Count the forwards of your sub-organizations too. By default only
     *     your own organization's are counted. Server default: false.
     * @param DomainForwardStatisticsBreakdown|string|null $breakdown Adds a top list of the redirects grouped by
     *     this dimension; `none` adds none. `country` is derived from the visitor's IP address with GeoLite2 data
     *     created by MaxMind (https://www.maxmind.com); an empty key means unknown. `status_code` is the redirect
     *     code configured on the rule. `domain` cannot be combined with the `domain` filter. `url` lists host and
     *     path of the redirected requests (`www.example.com/shop`, no query string). Request paths are kept for 13
     *     months only as daily top lists: per domain and day, the 5 values with the most hits, each with at least 3
     *     hits that day. It therefore needs a `domain` filter, cannot be combined with `hostname` or `protocol`, and
     *     sums the daily lists, so a path that did not make a day's list is missing for that day. There is no list
     *     of URLs across all domains of an organization. Server default: none.
     * @param int|null $breakdownLimit How many items the breakdown lists. Server default: 10.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getDomainForwardStatistics(
        ?string $hostname = null,
        ?string $domain = null,
        ?\DateTimeImmutable $startDate = null,
        ?\DateTimeImmutable $endDate = null,
        ?\DateTimeImmutable $start = null,
        ?\DateTimeImmutable $end = null,
        DomainForwardStatisticsGranularity|string|null $granularity = null,
        HttpProtocol|string|null $protocol = null,
        ?bool $excludeBots = null,
        ?bool $includeSubOrganizations = null,
        DomainForwardStatisticsBreakdown|string|null $breakdown = null,
        ?int $breakdownLimit = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardStatisticsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_STATISTICS,
            query: ['hostname' => $hostname, 'domain' => $domain, 'start_date' => $startDate === null ? null : $startDate->format('Y-m-d'), 'end_date' => $endDate === null ? null : $endDate->format('Y-m-d'), 'start' => $start, 'end' => $end, 'granularity' => $granularity, 'protocol' => $protocol, 'exclude_bots' => $excludeBots, 'include_sub_organizations' => $includeSubOrganizations, 'breakdown' => $breakdown, 'breakdown_limit' => $breakdownLimit],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardStatisticsResponse => DomainForwardStatisticsResponse::fromArray($data));
    }

    /**
     * List the domains whose redirects changed most
     *
     * Lists the domains of your organization whose redirects dropped (or rose) most in a fixed period (7
     * or 30 days) ending on the newest day that is over, against the period of the same length before it.
     * A sharp drop often means the domain no longer points at the OpusDNS redirect servers; a sharp rise
     * can be a campaign or a misconfigured redirect loop. Domains with fewer visits than `min_visits` in
     * both periods are left out.
     *
     * Both periods are whole UTC days: `period_end` is the newest day that is over, so the running day
     * never counts. `change_ratio` is null for a domain that had no redirects in the previous period.
     * `complete` is false while the previous period begins before `data_available_from`: its counts are
     * then too low, and a rise may only be the data catching up.
     *
     * Without `include_sub_organizations` the list covers the forwards of your organization only.
     * Statistics stay with the organization that owned the forward at the time of the redirect, as on
     * `/statistics`.
     *
     * The route answers 501 where statistics are not available in this environment.
     *
     * Required permissions: domain_forwards:read
     *
     * @param DomainForwardMoversPeriod|string|null $period Window compared with the window of the same length before
     *     it Server default: 30d.
     * @param DomainForwardMoverDirection|string|null $direction `drop` lists the domains that lost the most
     *     redirects, `rise` those that gained the most Server default: drop.
     * @param int|null $limit Number of domains to return Server default: 20.
     * @param int|null $minVisits Leave out domains with fewer visits than this in both windows Server default: 100.
     * @param bool|null $excludeBots Leave out bots: redirects whose platform is `Bot` or `Unknown`, and crawlers
     *     that their user agent names (Googlebot, Applebot, Meta's crawlers and others) whatever platform they
     *     report. Redirects stored before November 2026 count by platform only, as the `/metrics` routes do. Server
     *     default: false.
     * @param bool|null $includeSubOrganizations Count the forwards of your sub-organizations too. By default only
     *     your own organization's are counted. Server default: false.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listDomainForwardMovers(
        DomainForwardMoversPeriod|string|null $period = null,
        DomainForwardMoverDirection|string|null $direction = null,
        ?int $limit = null,
        ?int $minVisits = null,
        ?bool $excludeBots = null,
        ?bool $includeSubOrganizations = null,
        ?string $xDatetimeFormat = null,
    ): DomainForwardMoversResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAIN_FORWARDS_STATISTICS_MOVERS,
            query: ['period' => $period, 'direction' => $direction, 'limit' => $limit, 'min_visits' => $minVisits, 'exclude_bots' => $excludeBots, 'include_sub_organizations' => $includeSubOrganizations],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardMoversResponse => DomainForwardMoversResponse::fromArray($data));
    }

    /**
     * Get a domain forward
     *
     * Retrieves the domain forward configuration for the specified hostname
     *
     * Required permissions: domain_forwards:read
     *
     * @param string $hostname Hostname
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
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
