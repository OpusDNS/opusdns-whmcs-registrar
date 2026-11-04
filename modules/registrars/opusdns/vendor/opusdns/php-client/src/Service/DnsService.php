<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\DnsMoverDirection;
use OpusDNS\Client\Enum\DnsMoversPeriod;
use OpusDNS\Client\Enum\DnsStatisticsPeriod;
use OpusDNS\Client\Enum\DnsZoneRank;
use OpusDNS\Client\Enum\DnssecStatus;
use OpusDNS\Client\Enum\DomainForwardZoneSortField;
use OpusDNS\Client\Enum\EmailForwardZoneSortField;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Enum\TagFilterMode;
use OpusDNS\Client\Enum\UsageGranularity;
use OpusDNS\Client\Enum\ZoneIncludeField;
use OpusDNS\Client\Enum\ZoneSortField;
use OpusDNS\Client\Model\DnsChangesResponse;
use OpusDNS\Client\Model\DnsInactiveZonesResponse;
use OpusDNS\Client\Model\DnsStatisticsResponse;
use OpusDNS\Client\Model\DnsTopZonesResponse;
use OpusDNS\Client\Model\DnsZoneCreate;
use OpusDNS\Client\Model\DnsZoneMoversResponse;
use OpusDNS\Client\Model\DnsZoneRecordsPatchOps;
use OpusDNS\Client\Model\DnsZoneResponse;
use OpusDNS\Client\Model\DnsZoneRrsetsCreate;
use OpusDNS\Client\Model\DnsZoneRrsetsPatchOps;
use OpusDNS\Client\Model\DnsZoneSummary;
use OpusDNS\Client\Model\DnsZoneVanitySetUpdateRes;
use OpusDNS\Client\Model\DomainForwardZone;
use OpusDNS\Client\Model\EmailForwardZone;
use OpusDNS\Client\Model\PaginationDnsZoneResponse;
use OpusDNS\Client\Model\PaginationDomainForwardZone;
use OpusDNS\Client\Model\PaginationEmailForwardZone;
use OpusDNS\Client\Model\ZoneNxdomainStatisticsResponse;
use OpusDNS\Client\Model\ZoneStatisticsResponse;
use OpusDNS\Client\Model\ZoneVanitySetUpdate;

/**
 * Operations tagged "dns".
 */
final class DnsService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List Zones
     *
     * Required permissions: dns:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param ZoneSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param list<string>|null $tagIds Filter by user tag IDs. Can be specified multiple times.
     * @param TagFilterMode|string|null $tagMode How to combine tag_ids: 'match_any' returns objects with at least
     *     one of the tags, 'match_all' returns objects with every tag, 'match_none' returns objects with none of the
     *     tags, including objects that carry no user tags at all. Has no effect unless one or more tag_ids are
     *     supplied; to filter on whether an object has any user tag, use has_tags. Server default: match_any.
     * @param bool|null $hasTags true returns only objects that carry at least one user tag, false only objects that
     *     carry none. Status tags are not counted. Combines with tag_ids and the other filters.
     * @param DnssecStatus|string|null $dnssecStatus Filter by DNSSEC status
     * @param string|null $name Filter by exact zone name
     * @param string|null $search Search zones by name (contains)
     * @param string|null $suffix Filter zones by TLD/suffix (e.g., 'com', 'io', 'co.uk')
     * @param string|null $vanityNameserverSetId Filter zones by the vanity nameserver set branding them
     * @param \DateTimeImmutable|null $createdAfter Filter zones created after this date
     * @param \DateTimeImmutable|null $createdBefore Filter zones created before this date
     * @param \DateTimeImmutable|null $updatedAfter Filter zones updated after this date
     * @param \DateTimeImmutable|null $updatedBefore Filter zones updated before this date
     * @param list<ZoneIncludeField|string>|null $include Include additional data in the response. Can be specified
     *     multiple times.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listZones(
        ?int $page = null,
        ?int $pageSize = null,
        ZoneSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?array $tagIds = null,
        TagFilterMode|string|null $tagMode = null,
        ?bool $hasTags = null,
        DnssecStatus|string|null $dnssecStatus = null,
        ?string $name = null,
        ?string $search = null,
        ?string $suffix = null,
        ?string $vanityNameserverSetId = null,
        ?\DateTimeImmutable $createdAfter = null,
        ?\DateTimeImmutable $createdBefore = null,
        ?\DateTimeImmutable $updatedAfter = null,
        ?\DateTimeImmutable $updatedBefore = null,
        ?array $include = null,
        ?string $xDatetimeFormat = null,
    ): PaginationDnsZoneResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS,
            query: ['page' => $page, 'page_size' => $pageSize, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'tag_ids' => $tagIds, 'tag_mode' => $tagMode, 'has_tags' => $hasTags, 'dnssec_status' => $dnssecStatus, 'name' => $name, 'search' => $search, 'suffix' => $suffix, 'vanity_nameserver_set_id' => $vanityNameserverSetId, 'created_after' => $createdAfter, 'created_before' => $createdBefore, 'updated_after' => $updatedAfter, 'updated_before' => $updatedBefore, 'include' => $include],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationDnsZoneResponse => PaginationDnsZoneResponse::fromArray($data));
    }

    /**
     * Create Zone
     *
     * Required permissions: dns:manage
     *
     * @param DnsZoneCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function createZone(DnsZoneCreate|array $body, ?string $xDatetimeFormat = null): ?DnsChangesResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::DNS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsChangesResponse => DnsChangesResponse::fromArray($data), optional: true);
    }

    /**
     * List domain forwards by zone
     *
     * Retrieves a paginated list of domain forwards grouped by DNS zones.
     *
     * Required permissions: dns:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $search Search by zone name
     * @param DomainForwardZoneSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listDomainForwardsByZone(
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        DomainForwardZoneSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $xDatetimeFormat = null,
    ): PaginationDomainForwardZone {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_DOMAIN_FORWARDS,
            query: ['page' => $page, 'page_size' => $pageSize, 'search' => $search, 'sort_by' => $sortBy, 'sort_order' => $sortOrder],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationDomainForwardZone => PaginationDomainForwardZone::fromArray($data));
    }

    /**
     * List email forwards by zone
     *
     * Retrieves a paginated list of email forwards grouped by DNS zones.
     *
     * Required permissions: dns:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $search Search by zone name
     * @param EmailForwardZoneSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listEmailForwardsByZone(
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        EmailForwardZoneSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $xDatetimeFormat = null,
    ): PaginationEmailForwardZone {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_EMAIL_FORWARDS,
            query: ['page' => $page, 'page_size' => $pageSize, 'search' => $search, 'sort_by' => $sortBy, 'sort_order' => $sortOrder],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationEmailForwardZone => PaginationEmailForwardZone::fromArray($data));
    }

    /**
     * Get DNS query statistics of the organization
     *
     * Counts the DNS queries answered for all zones of your organization, how many of them were NXDOMAIN,
     * and how many zones had queries, in a window of whole UTC days bucketed by the requested granularity.
     * The window may span at most 366 days at `granularity=day` or `week` and 120 calendar months at
     * `granularity=month`.
     *
     * The numbers cover all DNS zones of your organization, and with `include_sub_organizations=true`
     * those of its sub-organizations too. A zone counts for its current owner with its whole history: a
     * zone moved to your organization brings its earlier queries along, and a deleted zone no longer
     * counts. They are recomputed after each new day of data and after zones changed owner or were
     * deleted; `statistics_updated_at` tells when.
     *
     * Every bucket the window touches is present, oldest first, so the series can be charted as is. A
     * bucket counts the days it shares with the window and with
     * `data_available_from`..`data_available_to`, from `covered_from` to `covered_to`; without a recorded
     * query on them it counts zero. A bucket without such a day carries null counts: no data, rather than
     * no queries. A bucket marked `partial` counts only part of its span; one with null counts is partial
     * too. Statistics are collected once a day, so the newest day with data is usually yesterday.
     *
     * Required permissions: dns:read
     *
     * @param \DateTimeImmutable $startDate First day of the window, inclusive (YYYY-MM-DD, UTC)
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive (YYYY-MM-DD, UTC). How far it may reach
     *     depends on `granularity`: at most 366 days for `day` and `week`, and 120 calendar months for `month`.
     * @param UsageGranularity|string|null $granularity Time-bucket size. Weeks start on Monday and months on the
     *     1st, in UTC. Server default: day.
     * @param bool|null $includeSubOrganizations Also count the zones of the organization's sub-organizations (up to
     *     three levels), like the domain statistics do Server default: false.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getDnsStatistics(
        \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate,
        UsageGranularity|string|null $granularity = null,
        ?bool $includeSubOrganizations = null,
        ?string $xDatetimeFormat = null,
    ): DnsStatisticsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_STATISTICS,
            query: ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d'), 'granularity' => $granularity, 'include_sub_organizations' => $includeSubOrganizations],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsStatisticsResponse => DnsStatisticsResponse::fromArray($data));
    }

    /**
     * List the zones without DNS queries
     *
     * Lists the zones of your organization that answered no query in a fixed period (7, 30 or 90 days)
     * ending on the newest day with data, by name. A zone without any query is most likely not delegated
     * to the OpusDNS nameservers: check the nameservers of its domain. Zones created within the period are
     * included; `zone_created_on` tells them apart.
     *
     * The numbers cover all DNS zones of your organization, and with `include_sub_organizations=true`
     * those of its sub-organizations too. A zone counts for its current owner with its whole history: a
     * zone moved to your organization brings its earlier queries along, and a deleted zone no longer
     * counts. They are recomputed after each new day of data and after zones changed owner or were
     * deleted; `statistics_updated_at` tells when.
     *
     * Required permissions: dns:read
     *
     * @param DnsStatisticsPeriod|string|null $period Window without queries Server default: 30d.
     * @param int|null $page Page number Server default: 1.
     * @param int|null $pageSize Zones per page Server default: 100.
     * @param bool|null $includeSubOrganizations Also count the zones of the organization's sub-organizations (up to
     *     three levels), like the domain statistics do Server default: false.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listDnsInactiveZones(
        DnsStatisticsPeriod|string|null $period = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?bool $includeSubOrganizations = null,
        ?string $xDatetimeFormat = null,
    ): DnsInactiveZonesResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_STATISTICS_INACTIVE_ZONES,
            query: ['period' => $period, 'page' => $page, 'page_size' => $pageSize, 'include_sub_organizations' => $includeSubOrganizations],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsInactiveZonesResponse => DnsInactiveZonesResponse::fromArray($data));
    }

    /**
     * List the zones whose DNS queries changed most
     *
     * Lists the zones of your organization whose queries dropped (or rose) most in a fixed period (7 or 30
     * days) ending on the newest day with data, against the period of the same length before it. A sharp
     * drop often means the domain no longer points at the OpusDNS nameservers; a sharp rise can be a
     * campaign, a migration or an attack. Zones below `min_query_count` in both periods are left out, and
     * so are zones created after the earlier period began, whose rise is only their creation.
     *
     * The numbers cover all DNS zones of your organization, and with `include_sub_organizations=true`
     * those of its sub-organizations too. A zone counts for its current owner with its whole history: a
     * zone moved to your organization brings its earlier queries along, and a deleted zone no longer
     * counts. They are recomputed after each new day of data and after zones changed owner or were
     * deleted; `statistics_updated_at` tells when.
     *
     * Required permissions: dns:read
     *
     * @param DnsMoversPeriod|string|null $period Window compared with the window of the same length before it Server
     *     default: 30d.
     * @param DnsMoverDirection|string|null $direction `drop` lists the zones that lost the most queries, `rise`
     *     those that gained the most Server default: drop.
     * @param int|null $limit Number of zones to return Server default: 20.
     * @param int|null $minQueryCount Leave out zones with fewer queries than this in both windows Server default:
     *     100.
     * @param bool|null $includeSubOrganizations Also count the zones of the organization's sub-organizations (up to
     *     three levels), like the domain statistics do Server default: false.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listDnsZoneMovers(
        DnsMoversPeriod|string|null $period = null,
        DnsMoverDirection|string|null $direction = null,
        ?int $limit = null,
        ?int $minQueryCount = null,
        ?bool $includeSubOrganizations = null,
        ?string $xDatetimeFormat = null,
    ): DnsZoneMoversResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_STATISTICS_MOVERS,
            query: ['period' => $period, 'direction' => $direction, 'limit' => $limit, 'min_query_count' => $minQueryCount, 'include_sub_organizations' => $includeSubOrganizations],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsZoneMoversResponse => DnsZoneMoversResponse::fromArray($data));
    }

    /**
     * List the zones with the most DNS queries
     *
     * Ranks the zones of your organization by queries, NXDOMAIN answers or NXDOMAIN share over a fixed
     * period (7, 30 or 90 days) ending on the newest day with data. Zones without queries in the period
     * are left out. A high NXDOMAIN share often points at missing records or typos in links.
     *
     * The numbers cover all DNS zones of your organization, and with `include_sub_organizations=true`
     * those of its sub-organizations too. A zone counts for its current owner with its whole history: a
     * zone moved to your organization brings its earlier queries along, and a deleted zone no longer
     * counts. They are recomputed after each new day of data and after zones changed owner or were
     * deleted; `statistics_updated_at` tells when.
     *
     * Required permissions: dns:read
     *
     * @param DnsStatisticsPeriod|string|null $period Window of the ranking Server default: 30d.
     * @param DnsZoneRank|string|null $rankBy Order of the zones: by queries, by NXDOMAIN answers, or by the NXDOMAIN
     *     share of their queries (raise `min_query_count` to leave out zones with a handful of queries) Server
     *     default: queries.
     * @param int|null $limit Number of zones to return Server default: 20.
     * @param int|null $minQueryCount Leave out zones with fewer queries in the period Server default: 0.
     * @param bool|null $includeSubOrganizations Also count the zones of the organization's sub-organizations (up to
     *     three levels), like the domain statistics do Server default: false.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listDnsTopZones(
        DnsStatisticsPeriod|string|null $period = null,
        DnsZoneRank|string|null $rankBy = null,
        ?int $limit = null,
        ?int $minQueryCount = null,
        ?bool $includeSubOrganizations = null,
        ?string $xDatetimeFormat = null,
    ): DnsTopZonesResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_STATISTICS_TOP_ZONES,
            query: ['period' => $period, 'rank_by' => $rankBy, 'limit' => $limit, 'min_query_count' => $minQueryCount, 'include_sub_organizations' => $includeSubOrganizations],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsTopZonesResponse => DnsTopZonesResponse::fromArray($data));
    }

    /**
     * Get Zones Summary
     *
     * Required permissions: dns:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getZonesSummary(?string $xDatetimeFormat = null): DnsZoneSummary
    {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_SUMMARY,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsZoneSummary => DnsZoneSummary::fromArray($data));
    }

    /**
     * Get Zone
     *
     * Required permissions: dns:read
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param list<ZoneIncludeField|string>|null $include
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getZone(
        string $zoneName,
        ?array $include = null,
        ?string $xDatetimeFormat = null,
    ): DnsZoneResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_BY_ZONE_NAME,
            path: ['zone_name' => $zoneName],
            query: ['include' => $include],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsZoneResponse => DnsZoneResponse::fromArray($data));
    }

    /**
     * Delete Zone
     *
     * Required permissions: dns:delete
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function deleteZone(string $zoneName, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::DNS_BY_ZONE_NAME,
            path: ['zone_name' => $zoneName],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Disable Dnssec
     *
     * Required permissions: dns:manage
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function disableDnssec(string $zoneName, ?string $xDatetimeFormat = null): DnsChangesResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::DNS_BY_ZONE_NAME_DNSSEC_DISABLE,
            path: ['zone_name' => $zoneName],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsChangesResponse => DnsChangesResponse::fromArray($data));
    }

    /**
     * Enable Dnssec
     *
     * Required permissions: dns:manage
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function enableDnssec(string $zoneName, ?string $xDatetimeFormat = null): DnsChangesResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::DNS_BY_ZONE_NAME_DNSSEC_ENABLE,
            path: ['zone_name' => $zoneName],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsChangesResponse => DnsChangesResponse::fromArray($data));
    }

    /**
     * List domain forwards for a zone
     *
     * Retrieves all domain forwards configured for the specified DNS zone, including subdomains.
     *
     * Required permissions: dns:read
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listZoneDomainForwards(string $zoneName, ?string $xDatetimeFormat = null): DomainForwardZone
    {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_BY_ZONE_NAME_DOMAIN_FORWARDS,
            path: ['zone_name' => $zoneName],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainForwardZone => DomainForwardZone::fromArray($data));
    }

    /**
     * List email forwards for a zone
     *
     * Retrieves all email forwards configured for the specified DNS zone, including subdomains and all
     * aliases.
     *
     * Required permissions: dns:read
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listZoneEmailForwards(string $zoneName, ?string $xDatetimeFormat = null): EmailForwardZone
    {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_BY_ZONE_NAME_EMAIL_FORWARDS,
            path: ['zone_name' => $zoneName],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): EmailForwardZone => EmailForwardZone::fromArray($data));
    }

    /**
     * Patch Zone Records
     *
     * Required permissions: dns:manage
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param DnsZoneRecordsPatchOps|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function patchZoneRecords(
        string $zoneName,
        DnsZoneRecordsPatchOps|array $body,
        ?string $xDatetimeFormat = null,
    ): void {
        $this->client->request(
            'PATCH',
            Endpoint::DNS_BY_ZONE_NAME_RECORDS,
            path: ['zone_name' => $zoneName],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Update Zone Rrsets
     *
     * Required permissions: dns:manage
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param DnsZoneRrsetsCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function updateZoneRrsets(
        string $zoneName,
        DnsZoneRrsetsCreate|array $body,
        ?string $xDatetimeFormat = null,
    ): void {
        $this->client->request(
            'PUT',
            Endpoint::DNS_BY_ZONE_NAME_RRSETS,
            path: ['zone_name' => $zoneName],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Patch Zone Rrsets
     *
     * Required permissions: dns:manage
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param DnsZoneRrsetsPatchOps|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function patchZoneRrsets(
        string $zoneName,
        DnsZoneRrsetsPatchOps|array $body,
        ?string $xDatetimeFormat = null,
    ): void {
        $this->client->request(
            'PATCH',
            Endpoint::DNS_BY_ZONE_NAME_RRSETS,
            path: ['zone_name' => $zoneName],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Get zone query statistics
     *
     * Counts the DNS queries answered for the zone, and how many of them were NXDOMAIN, in a window of
     * whole UTC days, bucketed by the requested granularity. The window may span at most 366 days at
     * `granularity=day` or `week` and 120 calendar months at `granularity=month`.
     *
     * Every bucket the window touches is present, oldest first, so the series can be charted as is. A
     * bucket counts the days it shares with the window and with
     * `data_available_from`..`data_available_to`, from `covered_from` to `covered_to`; without a recorded
     * query on them it counts zero. A bucket without such a day carries null counts: no data, rather than
     * no queries. A bucket marked `partial` counts only part of its span, because the window or the stored
     * data cuts it, or starts on the day the zone was created, which is counted whole. A bucket with null
     * counts is partial too.
     *
     * Statistics are collected once a day, so the newest day with data is usually yesterday.
     * `data_available_from` and `data_available_to` report the days the statistics hold data for the zone,
     * never earlier than the day it was created.
     *
     * Required permissions: dns:read
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param \DateTimeImmutable $startDate First day of the window, inclusive (YYYY-MM-DD, UTC)
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive (YYYY-MM-DD, UTC). How far it may reach
     *     depends on `granularity`: at most 366 days for `day` and `week`, and 120 calendar months for `month`.
     * @param UsageGranularity|string|null $granularity Time-bucket size. Weeks start on Monday and months on the
     *     1st, in UTC. Server default: day.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getZoneStatistics(
        string $zoneName,
        \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate,
        UsageGranularity|string|null $granularity = null,
        ?string $xDatetimeFormat = null,
    ): ZoneStatisticsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_BY_ZONE_NAME_STATISTICS,
            path: ['zone_name' => $zoneName],
            query: ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d'), 'granularity' => $granularity],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ZoneStatisticsResponse => ZoneStatisticsResponse::fromArray($data));
    }

    /**
     * List the names of a zone answered with NXDOMAIN
     *
     * Lists the names queried in the zone that do not exist in it, answered with NXDOMAIN, with the type
     * they were queried with, summed over a window of at most 31 whole UTC days and ordered by count,
     * largest first. Use it to find what causes the NXDOMAIN answers of `GET
     * /v1/dns/{zone_name}/statistics`: typos, removed records, or clients probing for names such as
     * `autodiscover`.
     *
     * A name is listed only on days with more than 30 NXDOMAIN answers to it;
     * `totals.listed_nxdomain_count` sums the listed names, `totals.nxdomain_count` all NXDOMAIN answers
     * of the zone from the daily statistics, which end yesterday. The names are kept for 30 days plus
     * today and are updated hourly; `data_complete_to` is the newest day whose list is final, usually
     * yesterday. Days before the zone was created are not counted.
     *
     * Required permissions: dns:read
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param \DateTimeImmutable $startDate First day of the window, inclusive (YYYY-MM-DD, UTC)
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive (YYYY-MM-DD, UTC). The window spans at
     *     most 31 days, both ends included: the names are kept for 30 days plus today
     * @param string|null $qtype Only names queried with this type, such as A, AAAA or TXT
     * @param int|null $page Page number Server default: 1.
     * @param int|null $pageSize Names per page Server default: 100.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listZoneNxdomains(
        string $zoneName,
        \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate,
        ?string $qtype = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): ZoneNxdomainStatisticsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DNS_BY_ZONE_NAME_STATISTICS_NXDOMAINS,
            path: ['zone_name' => $zoneName],
            query: ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d'), 'qtype' => $qtype, 'page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ZoneNxdomainStatisticsResponse => ZoneNxdomainStatisticsResponse::fromArray($data));
    }

    /**
     * Assign or clear a zone's vanity nameserver set
     *
     * Required permissions: dns:manage, vanity_ns:manage
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param ZoneVanitySetUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function updateZoneVanitySet(
        string $zoneName,
        ZoneVanitySetUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): DnsZoneVanitySetUpdateRes {
        $response = $this->client->request(
            'PATCH',
            Endpoint::DNS_BY_ZONE_NAME_VANITY_SET,
            path: ['zone_name' => $zoneName],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DnsZoneVanitySetUpdateRes => DnsZoneVanitySetUpdateRes::fromArray($data));
    }
}
