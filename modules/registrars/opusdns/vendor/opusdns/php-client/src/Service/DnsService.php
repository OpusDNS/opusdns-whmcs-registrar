<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\DnssecStatus;
use OpusDNS\Client\Enum\DomainForwardZoneSortField;
use OpusDNS\Client\Enum\EmailForwardZoneSortField;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Enum\TagFilterMode;
use OpusDNS\Client\Enum\ZoneIncludeField;
use OpusDNS\Client\Enum\ZoneSortField;
use OpusDNS\Client\Model\DnsChangesResponse;
use OpusDNS\Client\Model\DnsZoneCreate;
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
     * @param ZoneSortField|string|null $sortBy Server default: created_on.
     * @param SortOrder|string|null $sortOrder Server default: desc.
     * @param list<string>|null $tagIds Filter by user tag IDs. Can be specified multiple times.
     * @param TagFilterMode|string|null $tagMode Server default: match_any.
     * @param list<ZoneIncludeField|string>|null $include Include additional data in the response. Can be specified
     *     multiple times.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listZones(
        ?int $page = null,
        ?int $pageSize = null,
        ZoneSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?array $tagIds = null,
        TagFilterMode|string|null $tagMode = null,
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
            query: ['page' => $page, 'page_size' => $pageSize, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'tag_ids' => $tagIds, 'tag_mode' => $tagMode, 'dnssec_status' => $dnssecStatus, 'name' => $name, 'search' => $search, 'suffix' => $suffix, 'vanity_nameserver_set_id' => $vanityNameserverSetId, 'created_after' => $createdAfter, 'created_before' => $createdBefore, 'updated_after' => $updatedAfter, 'updated_before' => $updatedBefore, 'include' => $include],
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param DomainForwardZoneSortField|string|null $sortBy Server default: created_on.
     * @param SortOrder|string|null $sortOrder Server default: desc.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param EmailForwardZoneSortField|string|null $sortBy Server default: created_on.
     * @param SortOrder|string|null $sortOrder Server default: desc.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * Get Zones Summary
     *
     * Required permissions: dns:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
     * Assign or clear a zone's vanity nameserver set
     *
     * Required permissions: dns:manage, vanity_ns:manage
     *
     * @param string $zoneName DNS zone name (trailing dot optional)
     * @param ZoneVanitySetUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
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
