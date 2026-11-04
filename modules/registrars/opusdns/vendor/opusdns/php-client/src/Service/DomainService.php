<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\AccountTypeFilterMode;
use OpusDNS\Client\Enum\ConnectedAccountType;
use OpusDNS\Client\Enum\DomainIncludeField;
use OpusDNS\Client\Enum\DomainListIncludeField;
use OpusDNS\Client\Enum\DomainSortField;
use OpusDNS\Client\Enum\DomainStatisticsBreakdown;
use OpusDNS\Client\Enum\Registrar;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Enum\StatusTagType;
use OpusDNS\Client\Enum\TagFilterMode;
use OpusDNS\Client\Enum\UsageGranularity;
use OpusDNS\Client\Model\ApiDomainTldSpecificBeModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ApiDomainTldSpecificCymruModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ApiDomainTldSpecificCzModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ApiDomainTldSpecificDkModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ApiDomainTldSpecificEuModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ApiDomainTldSpecificLtModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ApiDomainTldSpecificNuModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ApiDomainTldSpecificSeModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ApiDomainTldSpecificWalesModelsRequestAuthcodeResponse;
use OpusDNS\Client\Model\ClaimsNoticesRequest;
use OpusDNS\Client\Model\ClaimsNoticesResponse;
use OpusDNS\Client\Model\DomainAuthCodeResponse;
use OpusDNS\Client\Model\DomainCheckResponse;
use OpusDNS\Client\Model\DomainCreate;
use OpusDNS\Client\Model\DomainDnssecDataCreate;
use OpusDNS\Client\Model\DomainDnssecDataResponse;
use OpusDNS\Client\Model\DomainRenewRequest;
use OpusDNS\Client\Model\DomainRenewResponse;
use OpusDNS\Client\Model\DomainResponse;
use OpusDNS\Client\Model\DomainRestoreRequest;
use OpusDNS\Client\Model\DomainRestoreResponse;
use OpusDNS\Client\Model\DomainStatisticsResponse;
use OpusDNS\Client\Model\DomainSummaryResponse;
use OpusDNS\Client\Model\DomainTransferIn;
use OpusDNS\Client\Model\DomainTransitRequest;
use OpusDNS\Client\Model\DomainTransitResponse;
use OpusDNS\Client\Model\DomainUpdate;
use OpusDNS\Client\Model\DomainVerificationResponse;
use OpusDNS\Client\Model\DomainWithdrawRequest;
use OpusDNS\Client\Model\DomainWithdrawResponse;
use OpusDNS\Client\Model\NorIdDeclarationConfirmRequest;
use OpusDNS\Client\Model\NorIdDeclarationResponse;
use OpusDNS\Client\Model\NorIdResellerDeclarationRequest;
use OpusDNS\Client\Model\OutboundTransferRequest;
use OpusDNS\Client\Model\OutboundTransferResponse;
use OpusDNS\Client\Model\PaginationDomainResponse;
use OpusDNS\Client\Model\PaginationDomainVerificationResponse;

/**
 * Operations tagged "domain".
 */
final class DomainService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List all domains
     *
     * Retrieves a paginated list of all active domains.
     *
     * Required permissions: domains:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param DomainSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param list<StatusTagType|string>|null $statusTags Filter by status tag types. Can be specified multiple
     *     times.
     * @param TagFilterMode|string|null $statusTagMode How to combine status_tags: 'match_any' returns objects with
     *     at least one of the tags, 'match_all' returns objects with every tag, 'match_none' returns objects with
     *     none of the tags, including objects that carry no status tags at all. Has no effect unless one or more
     *     status_tags are supplied. Server default: match_any.
     * @param list<string>|null $tagIds Filter by user tag IDs. Can be specified multiple times.
     * @param TagFilterMode|string|null $tagMode How to combine tag_ids: 'match_any' returns objects with at least
     *     one of the tags, 'match_all' returns objects with every tag, 'match_none' returns objects with none of the
     *     tags, including objects that carry no user tags at all. Has no effect unless one or more tag_ids are
     *     supplied; to filter on whether an object has any user tag, use has_tags. Server default: match_any.
     * @param bool|null $hasTags true returns only objects that carry at least one user tag, false only objects that
     *     carry none. Status tags are not counted. Combines with tag_ids and the other filters.
     * @param string|null $name Filter by exact domain name
     * @param string|null $search Search domains by name (contains) or domain ID (exact match)
     * @param list<string>|null $tld Filter by top-level domain (e.g., 'com', 'org'). Can be specified multiple times
     *     (union of all provided values).
     * @param string|null $sld Filter by second-level domain
     * @param string|null $nameserver Filter domains whose nameserver hostnames contain this text, e.g. `cloudflare`
     *     or `ns1.example.com`. Matches the nameservers the domain currently delegates to. The text is matched
     *     literally, so `%` and `_` are not wildcards; a trailing dot on a single label anchors at a label boundary,
     *     so `ns1.` matches `ns1.example.com` but not `ns10.example.com`. Unlike the other filters this one reads
     *     the nameservers of every domain in scope, so expect a slower response, the more so the larger the
     *     portfolio.
     * @param bool|null $transferLock Filter by transfer lock status
     * @param bool|null $readOnly Filter by read-only status
     * @param bool|null $isPremium Filter by premium domain status
     * @param \DateTimeImmutable|null $createdAfter Filter domains created after this date
     * @param \DateTimeImmutable|null $createdBefore Filter domains created before this date
     * @param \DateTimeImmutable|null $updatedAfter Filter domains updated after this date
     * @param \DateTimeImmutable|null $updatedBefore Filter domains updated before this date
     * @param \DateTimeImmutable|null $expiresAfter Filter domains expiring after this date
     * @param \DateTimeImmutable|null $expiresBefore Filter domains expiring before this date
     * @param bool|null $expiresIn30Days Filter domains expiring within the next 30 days
     * @param bool|null $expiresIn60Days Filter domains expiring within the next 60 days
     * @param bool|null $expiresIn90Days Filter domains expiring within the next 90 days
     * @param \DateTimeImmutable|null $registeredAfter Filter domains registered after this date
     * @param \DateTimeImmutable|null $registeredBefore Filter domains registered before this date
     * @param \DateTimeImmutable|null $transferredAfter Filter domains transferred in after this date
     * @param \DateTimeImmutable|null $transferredBefore Filter domains transferred in before this date
     * @param list<string>|null $registryStatuses Filter domains by registry status. Can be specified multiple times
     *     (union of all provided values).
     * @param list<string>|null $registrarCredentialId Filter domains held at an external registrar by the connected
     *     registrar credential they were synced from. Can be specified multiple times (union of all provided
     *     values); combined with `registrar`, both must match. Matches exactly the domains whose `connected_account`
     *     field carries the id, so domains OpusDNS sponsors never match.
     * @param list<Registrar|string>|null $registrar Filter domains held at an external registrar by that registrar.
     *     Can be specified multiple times (union of all provided values); combined with `registrar_credential_id`,
     *     both must match. Matches exactly the domains whose `connected_account` field carries the registrar, so
     *     domains OpusDNS sponsors never match.
     * @param list<ConnectedAccountType|string>|null $accountType Filter domains by the type of the registry account
     *     they are held on: `ras` for domains on a registrar-abstraction (RAS) account synced from a connected
     *     external registrar, including those whose credential has since been deleted; `ams` for domains managed on
     *     a customer's own registry accreditation; `default` for all others, manually managed domains included
     *     (their accounts are typed `default`). Can be specified multiple times (union of all provided values).
     * @param AccountTypeFilterMode|string|null $accountTypeMode How to apply `account_type`: `match_any` keeps the
     *     domains on any of the listed types, `match_none` the domains on none of them (so
     *     `account_type=ras&account_type_mode=match_none` keeps every domain not on a RAS account, and naming every
     *     type keeps none). Has no effect without `account_type`. Server default: match_any.
     * @param list<DomainListIncludeField|string>|null $include Extra data to include in each result. `tags`
     *     populates the `tags` (user tags) and `status_tags` fields, which are otherwise null; filtering by
     *     `tag_ids` or `status_tags` alone does not populate them. `connected_account` populates the
     *     `connected_account` field for domains held at an external registrar or on the organization's own registry
     *     accreditation (AMS).
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getDomains(
        ?int $page = null,
        ?int $pageSize = null,
        DomainSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?array $statusTags = null,
        TagFilterMode|string|null $statusTagMode = null,
        ?array $tagIds = null,
        TagFilterMode|string|null $tagMode = null,
        ?bool $hasTags = null,
        ?string $name = null,
        ?string $search = null,
        ?array $tld = null,
        ?string $sld = null,
        ?string $nameserver = null,
        ?bool $transferLock = null,
        ?bool $readOnly = null,
        ?bool $isPremium = null,
        ?\DateTimeImmutable $createdAfter = null,
        ?\DateTimeImmutable $createdBefore = null,
        ?\DateTimeImmutable $updatedAfter = null,
        ?\DateTimeImmutable $updatedBefore = null,
        ?\DateTimeImmutable $expiresAfter = null,
        ?\DateTimeImmutable $expiresBefore = null,
        ?bool $expiresIn30Days = null,
        ?bool $expiresIn60Days = null,
        ?bool $expiresIn90Days = null,
        ?\DateTimeImmutable $registeredAfter = null,
        ?\DateTimeImmutable $registeredBefore = null,
        ?\DateTimeImmutable $transferredAfter = null,
        ?\DateTimeImmutable $transferredBefore = null,
        ?array $registryStatuses = null,
        ?array $registrarCredentialId = null,
        ?array $registrar = null,
        ?array $accountType = null,
        AccountTypeFilterMode|string|null $accountTypeMode = null,
        ?array $include = null,
        ?string $xDatetimeFormat = null,
    ): PaginationDomainResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAINS,
            query: ['page' => $page, 'page_size' => $pageSize, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'status_tags' => $statusTags, 'status_tag_mode' => $statusTagMode, 'tag_ids' => $tagIds, 'tag_mode' => $tagMode, 'has_tags' => $hasTags, 'name' => $name, 'search' => $search, 'tld' => $tld, 'sld' => $sld, 'nameserver' => $nameserver, 'transfer_lock' => $transferLock, 'read_only' => $readOnly, 'is_premium' => $isPremium, 'created_after' => $createdAfter, 'created_before' => $createdBefore, 'updated_after' => $updatedAfter, 'updated_before' => $updatedBefore, 'expires_after' => $expiresAfter, 'expires_before' => $expiresBefore, 'expires_in_30_days' => $expiresIn30Days, 'expires_in_60_days' => $expiresIn60Days, 'expires_in_90_days' => $expiresIn90Days, 'registered_after' => $registeredAfter, 'registered_before' => $registeredBefore, 'transferred_after' => $transferredAfter, 'transferred_before' => $transferredBefore, 'registry_statuses' => $registryStatuses, 'registrar_credential_id' => $registrarCredentialId, 'registrar' => $registrar, 'account_type' => $accountType, 'account_type_mode' => $accountTypeMode, 'include' => $include],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationDomainResponse => PaginationDomainResponse::fromArray($data));
    }

    /**
     * Create a domain
     *
     * Registers a new domain.
     *
     * - **Premium domains** - when the registry classifies the domain as premium, an `expected_price` must
     * be supplied to confirm the non-standard price returned by the availability check. See the [Premium
     * domains](/products/domains/premium) guide for background on how premium domains are priced and
     * registered. - **Trademark claims (TMCH)** - when the TLD is in its claims phase and the domain
     * matches a trademark in the Trademark Clearinghouse, a `claims_notice_acceptance_hash` must be
     * supplied to acknowledge the corresponding claims notice. See the [Trademarked
     * domains](/products/domains/trademarked-domains) guide for the full workflow.
     *
     * Required permissions: domains:manage
     *
     * @param DomainCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function createDomain(DomainCreate|array $body, ?string $xDatetimeFormat = null): DomainResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainResponse => DomainResponse::fromArray($data));
    }

    /**
     * Check domain availability and registration metadata
     *
     * Performs a real-time check against the authoritative registry for each domain and returns
     * availability plus any registry-specific metadata needed to register it.
     *
     * For each domain the response includes: - **Availability** - whether the domain can be registered,
     * and the registry's reason if not. - **Premium status and pricing** - whether the domain is
     * classified as premium by the registry, and if so, the price per action (create / renew / transfer /
     * restore). See the [Premium domains](/products/domains/premium) guide for background on how premium
     * domains are priced and registered. - **Trademark claims (TMCH)** - when the TLD is in its claims
     * phase and the domain matches a trademark in the Trademark Clearinghouse, a `claims_key` is returned.
     * See the [Trademarked domains](/products/domains/trademarked-domains) guide for the full workflow.
     *
     * Domains are queried in parallel, grouped by registry connection. Availability and metadata reflect
     * the registry's state at the moment of the call and are not cached.
     *
     * Required permissions: domains:read
     *
     * @param list<string> $domains One or more fully-qualified domain names to check at the registry. Each domain is
     *     checked for availability and, when applicable, enriched with trademark claims information and premium
     *     pricing. The list of domains may include a mix of TLDs.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function eppCheckDomain(array $domains, ?string $xDatetimeFormat = null): DomainCheckResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAINS_CHECK,
            query: ['domains' => $domains],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainCheckResponse => DomainCheckResponse::fromArray($data));
    }

    /**
     * Retrieve claims notices from claim keys
     *
     * Retrieves the trademark claims notice for a `claims_key` returned during a domain availability
     * check. The response contains a `claims_notice_acceptance_hash` to acknowledge the notice when
     * registering the domain, a ready-to-display `rendered_html`, and the structured fields needed to
     * render a custom notice. See the [Trademarked domains](/products/domains/trademarked-domains) guide
     * for the full workflow.
     *
     * Required permissions: domains:manage
     *
     * @param ClaimsNoticesRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getClaimsNotices(
        ClaimsNoticesRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): ClaimsNoticesResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_CLAIMS_NOTICES,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ClaimsNoticesResponse => ClaimsNoticesResponse::fromArray($data));
    }

    /**
     * Get domain statistics
     *
     * Counts the domains that moved in or out of your organization's portfolio in a window of whole days,
     * bucketed by the requested granularity: creates (new registrations), inbound transfers, deletes,
     * outbound transfers, renewals and restores, plus `net` (created and transferred in, minus deleted and
     * transferred out).
     *
     * Counts cover your organization's own domains, like the domain summary. With
     * `include_sub_organizations=true` they cover its sub-organizations too, and `breakdown=organization`
     * shows how they divide between them. A create is counted on the day OpusDNS took the order and a
     * transfer on the day it completed, so domains that have since been deleted still appear in the window
     * they were acquired in. Imported domains count as creates on the day they were imported. Renewals and
     * restores are counted once per day a domain was renewed or restored, so a domain renewed in two
     * different months counts in both. Domains held at a connected external registrar are not included.
     *
     * Every bucket the window touches is present, oldest first, so the series can be charted as is. A
     * bucket counts the days it shares with the window, from the day of `data_available_from` and up to
     * today, from `covered_from` to `covered_to`; without a movement on them it counts zero. A bucket
     * without such a day carries null counts: no data, rather than no movement. A bucket marked `partial`
     * does not count its whole span: the window, the start of the event log or today cuts it, it includes
     * the day the log begins on (unless at midnight), or it reaches today, which is still running. A
     * bucket with null counts is partial too.
     *
     * These counts are read from the domain event log, which begins later than the domains themselves;
     * `data_available_from` reports the oldest event it holds.
     *
     * Required permissions: domains:read
     *
     * @param \DateTimeImmutable $startDate First day of the window, inclusive (YYYY-MM-DD, UTC)
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive (YYYY-MM-DD, UTC). How far it may reach
     *     depends on `granularity`: at most 92 days for `day`, 371 days for `week`, 396 days for `month`.
     * @param UsageGranularity|string|null $granularity Time-bucket size. Weeks start on Monday and months on the
     *     1st, in UTC. Server default: day.
     * @param string|null $tld Restrict the counts to one top-level domain, e.g. `com`.
     * @param DomainStatisticsBreakdown|string|null $breakdown Adds a top-N list to the response: `organization`
     *     ranks your organization and its sub-organizations (so it needs `include_sub_organizations=true`), `tld`
     *     ranks the top-level domains. Server default: none.
     * @param int|null $breakdownLimit How many rows the breakdown lists. Server default: 10.
     * @param bool|null $includeSubOrganizations Count your sub-organizations' domains too. By default only your own
     *     organization's domains are counted, as in the domain summary. Server default: false.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getDomainStatistics(
        \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate,
        UsageGranularity|string|null $granularity = null,
        ?string $tld = null,
        DomainStatisticsBreakdown|string|null $breakdown = null,
        ?int $breakdownLimit = null,
        ?bool $includeSubOrganizations = null,
        ?string $xDatetimeFormat = null,
    ): DomainStatisticsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAINS_STATISTICS,
            query: ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d'), 'granularity' => $granularity, 'tld' => $tld, 'breakdown' => $breakdown, 'breakdown_limit' => $breakdownLimit, 'include_sub_organizations' => $includeSubOrganizations],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainStatisticsResponse => DomainStatisticsResponse::fromArray($data));
    }

    /**
     * Get domain summary
     *
     * Retrieves a summary of your organization's domains, with counts by status, status tag, TLD, registry
     * account type and expiration timeframe. Only `by_organization` includes sub-organizations. With
     * `account_type`, every count covers only the domains that filter keeps, so a sub-organization whose
     * domains all fall outside it is left out of `by_organization`, as one without domains always is.
     *
     * Required permissions: domains:read
     *
     * @param list<ConnectedAccountType|string>|null $accountType Filter domains by the type of the registry account
     *     they are held on: `ras` for domains on a registrar-abstraction (RAS) account synced from a connected
     *     external registrar, including those whose credential has since been deleted; `ams` for domains managed on
     *     a customer's own registry accreditation; `default` for all others, manually managed domains included
     *     (their accounts are typed `default`). Can be specified multiple times (union of all provided values).
     * @param AccountTypeFilterMode|string|null $accountTypeMode How to apply `account_type`: `match_any` keeps the
     *     domains on any of the listed types, `match_none` the domains on none of them (so
     *     `account_type=ras&account_type_mode=match_none` keeps every domain not on a RAS account, and naming every
     *     type keeps none). Has no effect without `account_type`. Server default: match_any.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getDomainSummary(
        ?array $accountType = null,
        AccountTypeFilterMode|string|null $accountTypeMode = null,
        ?string $xDatetimeFormat = null,
    ): DomainSummaryResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAINS_SUMMARY,
            query: ['account_type' => $accountType, 'account_type_mode' => $accountTypeMode],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainSummaryResponse => DomainSummaryResponse::fromArray($data));
    }

    /**
     * Withdraw a nic.at domain
     *
     * Required permissions: domains:manage
     *
     * @param DomainWithdrawRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function withdrawDomain(
        string $domainReference,
        DomainWithdrawRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): DomainWithdrawResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_AT_BY_DOMAIN_REFERENCE_WITHDRAW,
            path: ['domain_reference' => $domainReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainWithdrawResponse => DomainWithdrawResponse::fromArray($data));
    }

    /**
     * Requests your auth code directly from DNS Belgium (registry)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeBe(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificBeModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_BE_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificBeModelsRequestAuthcodeResponse => ApiDomainTldSpecificBeModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Generates a fresh auth code at Nominet (.cymru)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD. Nominet
     * expires a Transfer Authorisation Code after 14 days or on use in a transfer, and enforces complexity
     * requirements on it. This endpoint mints a compliant code, sets it through a `domain:update` and
     * returns it, invalidating any previous one. It is the only way to change a `.cymru` auth code.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeCymru(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificCymruModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_CYMRU_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificCymruModelsRequestAuthcodeResponse => ApiDomainTldSpecificCymruModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Requests your auth code directly from CZ.NIC (registry)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeCz(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificCzModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_CZ_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificCzModelsRequestAuthcodeResponse => ApiDomainTldSpecificCzModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Transit a DENIC domain
     *
     * Required permissions: domains:manage
     *
     * @param DomainTransitRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function transitDomain(
        string $domainReference,
        DomainTransitRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): DomainTransitResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_DE_BY_DOMAIN_REFERENCE_TRANSIT,
            path: ['domain_reference' => $domainReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainTransitResponse => DomainTransitResponse::fromArray($data));
    }

    /**
     * Requests your auth code directly from Punktum dk (registry)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeDk(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificDkModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_DK_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificDkModelsRequestAuthcodeResponse => ApiDomainTldSpecificDkModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Requests your auth code directly from EURid (registry)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeEu(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificEuModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_EU_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificEuModelsRequestAuthcodeResponse => ApiDomainTldSpecificEuModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Requests your auth code directly from DOMREG (registry)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeLt(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificLtModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_LT_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificLtModelsRequestAuthcodeResponse => ApiDomainTldSpecificLtModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Retrieve the .no applicant declaration by token
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getNoridDeclarationByToken(
        string $token,
        ?string $xDatetimeFormat = null,
    ): NorIdDeclarationResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAINS_TLD_SPECIFIC_NO_APPLICANT_DECLARATION,
            query: ['token' => $token],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): NorIdDeclarationResponse => NorIdDeclarationResponse::fromArray($data));
    }

    /**
     * Sign the .no applicant declaration with token
     *
     * Records the applicant declaration signature (`acceptName` + `acceptDate`) and queues the actual
     * registration at Norid.
     *
     * @param NorIdDeclarationConfirmRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function confirmNoridDeclarationByToken(
        string $token,
        NorIdDeclarationConfirmRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): void {
        $this->client->request(
            'PUT',
            Endpoint::DOMAINS_TLD_SPECIFIC_NO_APPLICANT_DECLARATION,
            query: ['token' => $token],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Submit the .no applicant declaration on behalf of the subscriber
     *
     * Records the applicant declaration signature collected by the registrar (e.g. via Norid's own signing
     * tool) and queues the actual registration at Norid, without the registrant email round-trip.
     *
     * Required permissions: domains:manage
     *
     * @param NorIdResellerDeclarationRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function submitNoridDeclaration(
        string $domainReference,
        NorIdResellerDeclarationRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): NorIdDeclarationResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_NO_BY_DOMAIN_REFERENCE_APPLICANT_DECLARATION,
            path: ['domain_reference' => $domainReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): NorIdDeclarationResponse => NorIdDeclarationResponse::fromArray($data));
    }

    /**
     * Resend the .no applicant declaration email to the registrant
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function resendNoridDeclarationEmail(string $domainReference, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_NO_BY_DOMAIN_REFERENCE_RESEND_DECLARATION_EMAIL,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Generates a fresh auth code at Internetstiftelsen (.nu)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD. `.nu` auth
     * codes are owned by the registry: registrars can only send the literal `auto`, and the generated code
     * is returned in the `iis:updData` extension of a `domain:update`. This endpoint runs that update and
     * stores the fresh code, invalidating any previous one.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeNu(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificNuModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_NU_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificNuModelsRequestAuthcodeResponse => ApiDomainTldSpecificNuModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Generates a fresh auth code at Internetstiftelsen (.se)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD. `.se` auth
     * codes are owned by the registry: registrars can only send the literal `auto`, and the generated code
     * is returned in the `iis:updData` extension of a `domain:update`. This endpoint runs that update and
     * stores the fresh code, invalidating any previous one.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeSe(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificSeModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_SE_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificSeModelsRequestAuthcodeResponse => ApiDomainTldSpecificSeModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Generates a fresh auth code at Nominet (.wales)
     *
     * Deprecated: use `POST /v1/domains/{domain_reference}/auth-code`, which handles every TLD. Nominet
     * expires a Transfer Authorisation Code after 14 days or on use in a transfer, and enforces complexity
     * requirements on it. This endpoint mints a compliant code, sets it through a `domain:update` and
     * returns it, invalidating any previous one. It is the only way to change a `.wales` auth code.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @deprecated
     */
    public function requestAuthCodeWales(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): ApiDomainTldSpecificWalesModelsRequestAuthcodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TLD_SPECIFIC_WALES_BY_DOMAIN_REFERENCE_AUTH_CODE_REQUEST,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ApiDomainTldSpecificWalesModelsRequestAuthcodeResponse => ApiDomainTldSpecificWalesModelsRequestAuthcodeResponse::fromArray($data));
    }

    /**
     * Transfer a domain
     *
     * Start the transfer process for a domain <br> The domain will be in state `pending_transfer` until
     * the transfer is completed. This process can take up to 5 days, until the transfer is approved
     *
     * Required permissions: domains:manage
     *
     * @param DomainTransferIn|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function transferDomain(DomainTransferIn|array $body, ?string $xDatetimeFormat = null): DomainResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_TRANSFER,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainResponse => DomainResponse::fromArray($data));
    }

    /**
     * Retrieve a domain
     *
     * Retrieves a single active domain by either its name or id.
     *
     * Required permissions: domains:read
     *
     * @param list<DomainIncludeField|string>|null $include Extra data to include in the response. `tags` populates
     *     the `tags` and `status_tags` fields, which are otherwise null. `renewal_price` resolves the domain's
     *     renewal price. `connected_account` populates the `connected_account` field for domains held at an external
     *     registrar or on the organization's own registry accreditation (AMS). `registrant_change` populates the
     *     `registrant_change` field with the change of registrant in progress.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getDomain(
        string $domainReference,
        ?array $include = null,
        ?string $xDatetimeFormat = null,
    ): DomainResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE,
            path: ['domain_reference' => $domainReference],
            query: ['include' => $include],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainResponse => DomainResponse::fromArray($data));
    }

    /**
     * Update a domain
     *
     * Updates various attributes of an existing domain. Only the fields provided in the request will be
     * updated; all other fields will remain unchanged. <br> Providing `clientTransferProhibited` as a
     * status will set the `transfer_lock` property. <br> `transfer_lock` is read-only and cannot be set
     * here: send it in the request body and it is ignored, leaving the lock unchanged. Use
     * `status_changes` to release a lock before a transfer out, for example `{"status_changes": {"remove":
     * ["clientTransferProhibited"]}}`.
     *
     * Required permissions: domains:manage
     *
     * @param DomainUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function updateDomain(
        string $domainReference,
        DomainUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): DomainResponse {
        $response = $this->client->request(
            'PATCH',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE,
            path: ['domain_reference' => $domainReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainResponse => DomainResponse::fromArray($data));
    }

    /**
     * Delete a domain
     *
     * Initiates the deletion process for a domain. The domain will be marked for deletion and will enter a
     * redemption period during which it may be restored.
     *
     * Required permissions: domains:delete
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function deleteDomain(string $domainReference, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Request an auth code
     *
     * Gets an auth code for the domain, following the registry's model. Where the registrar sets the code,
     * a new one is generated, set at the registry and returned, invalidating the previous one. Where the
     * registry generates it, it is requested there: `.eu` and `.lt` return the code already issued while
     * it is still valid, and `.nl` domains on SIDN DRS return the current token, which only SIDN can
     * reset. Registries that only send the code to the registrant (`.be`, `.cz`) answer with `delivery`
     * `registrant_email` and no code. TLDs without auth codes answer 422. `auth_code` is hidden when the
     * caller cannot view the domain's auth codes.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function requestDomainAuthCode(
        string $domainReference,
        ?string $xDatetimeFormat = null,
    ): DomainAuthCodeResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_AUTH_CODE,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainAuthCodeResponse => DomainAuthCodeResponse::fromArray($data));
    }

    /**
     * Retrieve DNSSEC data
     *
     * Fetches all DNSSEC records associated with the specified domain.
     *
     * Required permissions: domains:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<DomainDnssecDataResponse>
     */
    public function getDnssec(string $domainReference, ?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_DNSSEC,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): DomainDnssecDataResponse => DomainDnssecDataResponse::fromArray($item), $data));
    }

    /**
     * Update DNSSEC data
     *
     * Replaces all existing DNSSEC records for the domain with the provided records.
     *
     * Required permissions: domains:manage
     *
     * @param list<DomainDnssecDataCreate>|list<array<string, mixed>> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<DomainDnssecDataResponse>
     */
    public function createOrUpdateDnssec(string $domainReference, array $body, ?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'PUT',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_DNSSEC,
            path: ['domain_reference' => $domainReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): DomainDnssecDataResponse => DomainDnssecDataResponse::fromArray($item), $data));
    }

    /**
     * Delete DNSSEC data
     *
     * Removes all DNSSEC data for a domain
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function deleteDnssec(string $domainReference, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_DNSSEC,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Disable DNSSEC for domains using our nameservers
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function disableAndUnpublishDnssecRecords(string $domainReference, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'POST',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_DNSSEC_DISABLE,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Enable DNSSEC for domains using our nameservers
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<DomainDnssecDataResponse>
     */
    public function enableAndPublishDnssecRecords(string $domainReference, ?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_DNSSEC_ENABLE,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): DomainDnssecDataResponse => DomainDnssecDataResponse::fromArray($item), $data));
    }

    /**
     * Renew a domain
     *
     * Extends the registration period of an existing domain. The renewal period is added to the current
     * expiration date of the domain.
     *
     * For a domain held at another registrar, the renewal transfers the domain into OpusDNS and answers
     * 202 before the transfer starts.
     *
     * Required permissions: domains:manage
     *
     * @param DomainRenewRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function renewDomain(
        string $domainReference,
        DomainRenewRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): DomainRenewResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_RENEW,
            path: ['domain_reference' => $domainReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainRenewResponse => DomainRenewResponse::fromArray($data));
    }

    /**
     * Restore an eligible domain (during redemption period)
     *
     * Required permissions: domains:manage
     *
     * @param DomainRestoreRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function restoreDomain(
        string $domainReference,
        DomainRestoreRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): DomainRestoreResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_RESTORE,
            path: ['domain_reference' => $domainReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainRestoreResponse => DomainRestoreResponse::fromArray($data));
    }

    /**
     * Cancel a domain transfer
     *
     * This will cancel the in-progress domain transfer and delete the domain object
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function cancelDomainTransfer(string $domainReference, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_TRANSFER,
            path: ['domain_reference' => $domainReference],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Approve or reject an outbound domain transfer
     *
     * Required permissions: domains:manage
     *
     * @param OutboundTransferRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function resolveOutboundTransfer(
        string $domainReference,
        OutboundTransferRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): OutboundTransferResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_TRANSFER_OUTBOUND,
            path: ['domain_reference' => $domainReference],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): OutboundTransferResponse => OutboundTransferResponse::fromArray($data));
    }

    /**
     * List the verification cases of a domain
     *
     * Lists the verification cases of a domain, active and closed, newest first: what ICANN or the
     * registry asks to verify about the registrant, by when, and how the case ended.
     *
     * Required permissions: domains:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listDomainVerifications(
        string $domainReference,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): PaginationDomainVerificationResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_VERIFICATIONS,
            path: ['domain_reference' => $domainReference],
            query: ['page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationDomainVerificationResponse => PaginationDomainVerificationResponse::fromArray($data));
    }

    /**
     * Resend the verification email of an ICANN case
     *
     * Mails the registrant a link to confirm the email an open ICANN case waits on. The mail covers every
     * open ICANN case of that email in the organization and counts as a reminder: the scheduled reminders
     * resume at the first one due more than 24 hours later. At most one mail goes to an email in 15
     * minutes; an earlier request is answered 429 with `Retry-After`. Registry cases, closed cases, emails
     * already confirmed and organizations that confirm their registrants' emails themselves are answered
     * 409 with the reason.
     *
     * Required permissions: domains:manage
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function resendDomainVerification(
        string $domainReference,
        string $verificationId,
        ?string $xDatetimeFormat = null,
    ): DomainVerificationResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::DOMAINS_BY_DOMAIN_REFERENCE_VERIFICATIONS_BY_VERIFICATION_ID_RESEND,
            path: ['domain_reference' => $domainReference, 'verification_id' => $verificationId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): DomainVerificationResponse => DomainVerificationResponse::fromArray($data));
    }
}
