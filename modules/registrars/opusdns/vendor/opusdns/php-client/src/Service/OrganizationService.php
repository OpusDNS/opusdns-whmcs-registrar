<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\BillingTransactionAction;
use OpusDNS\Client\Enum\BillingTransactionProductType;
use OpusDNS\Client\Enum\BillingTransactionSortField;
use OpusDNS\Client\Enum\BillingTransactionStatus;
use OpusDNS\Client\Enum\OrganizationSortField;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Enum\UsageGranularity;
use OpusDNS\Client\Enum\UsageProduct;
use OpusDNS\Client\Enum\UserSortField;
use OpusDNS\Client\Enum\WaitlistProduct;
use OpusDNS\Client\Model\AiInferenceUsageSeriesResponse;
use OpusDNS\Client\Model\AiInferenceUsageSummaryResponse;
use OpusDNS\Client\Model\BillingTransactionResponse;
use OpusDNS\Client\Model\CustomRoleCreate;
use OpusDNS\Client\Model\CustomRoleUpdate;
use OpusDNS\Client\Model\GetPricesResponse;
use OpusDNS\Client\Model\IpRestrictionCreate;
use OpusDNS\Client\Model\IpRestrictionResponse;
use OpusDNS\Client\Model\IpRestrictionUpdate;
use OpusDNS\Client\Model\Organization;
use OpusDNS\Client\Model\OrganizationAttributeResponse;
use OpusDNS\Client\Model\OrganizationAttributeUpdate;
use OpusDNS\Client\Model\OrganizationCreate;
use OpusDNS\Client\Model\OrganizationUpdate;
use OpusDNS\Client\Model\OrganizationWithBillingData;
use OpusDNS\Client\Model\PaginationBillingTransactionResponse;
use OpusDNS\Client\Model\PaginationInvoiceResponse;
use OpusDNS\Client\Model\PaginationOrganization;
use OpusDNS\Client\Model\PaginationUserPublicWithRole;
use OpusDNS\Client\Model\PublicPermissionSet;
use OpusDNS\Client\Model\PublicRoleDefinition;
use OpusDNS\Client\Model\WaitlistApplyRequest;
use OpusDNS\Client\Model\WaitlistEntryResponse;
use OpusDNS\Client\Model\WaitlistProductListResponse;

/**
 * Operations tagged "organization".
 */
final class OrganizationService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List all organizations
     *
     * Retrieves a paginated list of organizations under the current organization
     *
     * Required permissions: organization:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param OrganizationSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param string|null $search Search across organization name, address, and city
     * @param string|null $countryCode Filter by country code
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listOrganizations(
        ?int $page = null,
        ?int $pageSize = null,
        OrganizationSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $search = null,
        ?string $countryCode = null,
        ?string $xDatetimeFormat = null,
    ): PaginationOrganization {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS,
            query: ['page' => $page, 'page_size' => $pageSize, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'search' => $search, 'country_code' => $countryCode],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationOrganization => PaginationOrganization::fromArray($data));
    }

    /**
     * Create an organization
     *
     * Create a new organization under the current organization
     *
     * @param OrganizationCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function createOrganization(OrganizationCreate|array $body, ?string $xDatetimeFormat = null): Organization
    {
        $response = $this->client->request(
            'POST',
            Endpoint::ORGANIZATIONS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): Organization => Organization::fromArray($data));
    }

    /**
     * List organization attributes
     *
     * Retrieves a list of organization attributes for the current organization
     *
     * Required permissions: organization:read
     *
     * @param list<string>|null $keys Optional list of attribute keys to filter
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<OrganizationAttributeResponse>
     */
    public function getCurrentOrganizationAttributes(?array $keys = null, ?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_ATTRIBUTES,
            query: ['keys' => $keys],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): OrganizationAttributeResponse => OrganizationAttributeResponse::fromArray($item), $data));
    }

    /**
     * Update organization attributes
     *
     * Updates one or more organization attributes for the current organization. Setting a billing, pricing
     * or abuse notification email requires the organization owner or an admin of a parent organization.
     *
     * @param list<OrganizationAttributeUpdate>|list<array<string, mixed>> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<OrganizationAttributeResponse>
     */
    public function updateCurrentOrganizationAttributes(array $body, ?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'PATCH',
            Endpoint::ORGANIZATIONS_ATTRIBUTES,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): OrganizationAttributeResponse => OrganizationAttributeResponse::fromArray($item), $data));
    }

    /**
     * List IP restrictions
     *
     * List all IP restrictions for the organization.
     *
     * Returns a list of all IP restrictions configured for your organization. Single IP addresses are
     * returned with CIDR notation (/32 for IPv4, /128 for IPv6).
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<IpRestrictionResponse>
     */
    public function listIpRestrictions(?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_IP_RESTRICTIONS,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): IpRestrictionResponse => IpRestrictionResponse::fromArray($item), $data));
    }

    /**
     * Create an IP restriction
     *
     * Create a new IP restriction for the organization.
     *
     * Accepts either a single IP address or a CIDR network range. Individual IP addresses are stored and
     * returned with CIDR notation (/32 for IPv4, /128 for IPv6).
     *
     * @param IpRestrictionCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function createIpRestriction(
        IpRestrictionCreate|array $body,
        ?string $xDatetimeFormat = null,
    ): IpRestrictionResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::ORGANIZATIONS_IP_RESTRICTIONS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): IpRestrictionResponse => IpRestrictionResponse::fromArray($data));
    }

    /**
     * Get an IP restriction
     *
     * Get a specific IP restriction by ID.
     *
     * Returns the details of a specific IP restriction if it exists and belongs to your organization.
     * Single IP addresses are returned with CIDR notation (/32 for IPv4, /128 for IPv6).
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getIpRestriction(int $ipRestrictionId, ?string $xDatetimeFormat = null): IpRestrictionResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_IP_RESTRICTIONS_BY_IP_RESTRICTION_ID,
            path: ['ip_restriction_id' => $ipRestrictionId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): IpRestrictionResponse => IpRestrictionResponse::fromArray($data));
    }

    /**
     * Update an IP restriction
     *
     * Update an existing IP restriction.
     *
     * You can update the IP network range or the last usage timestamp. Individual IP addresses are stored
     * and returned with CIDR notation (/32 for IPv4, /128 for IPv6).
     *
     * @param IpRestrictionUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function updateIpRestriction(
        int $ipRestrictionId,
        IpRestrictionUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): IpRestrictionResponse {
        $response = $this->client->request(
            'PATCH',
            Endpoint::ORGANIZATIONS_IP_RESTRICTIONS_BY_IP_RESTRICTION_ID,
            path: ['ip_restriction_id' => $ipRestrictionId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): IpRestrictionResponse => IpRestrictionResponse::fromArray($data));
    }

    /**
     * Delete an IP restriction
     *
     * Delete an IP restriction.
     *
     * Permanently removes the specified IP restriction from your organization.
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function deleteIpRestriction(int $ipRestrictionId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::ORGANIZATIONS_IP_RESTRICTIONS_BY_IP_RESTRICTION_ID,
            path: ['ip_restriction_id' => $ipRestrictionId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * List product waitlists
     *
     * Lists the waitlisted products your organization has been invited to, or that you have already
     * applied for, with where your own application stands on each. Any other product is omitted entirely.
     * An API key sees the invited products but has no application of its own: `status` is null and
     * `can_apply` is false.
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listProductWaitlists(?string $xDatetimeFormat = null): WaitlistProductListResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_PRODUCT_WAITLIST,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): WaitlistProductListResponse => WaitlistProductListResponse::fromArray($data));
    }

    /**
     * Apply for a product waitlist
     *
     * Applies you for a product's waitlist, optionally saying what you would use the product for. Any
     * member of an invited organization may apply. The application is recorded as `pending` until OpusDNS
     * decides on it. One application per user per product: a second apply is refused, and a rejection is
     * reconsidered by OpusDNS rather than by applying again. A colleague's application does not stand in
     * for yours, nor block it.
     *
     * Required permissions: organization:read
     *
     * @param WaitlistApplyRequest|array<string, mixed>|null $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function applyForProductWaitlist(
        WaitlistProduct|string $product,
        WaitlistApplyRequest|array|null $body = null,
        ?string $xDatetimeFormat = null,
    ): WaitlistEntryResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::ORGANIZATIONS_PRODUCT_WAITLIST_BY_PRODUCT_APPLY,
            path: ['product' => $product],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): WaitlistEntryResponse => WaitlistEntryResponse::fromArray($data));
    }

    /**
     * List grantable role permissions
     *
     * Retrieves the catalog of `resource:scope` permissions a custom role may grant
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listRolePermissions(?string $xDatetimeFormat = null): PublicPermissionSet
    {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_ROLE_PERMISSIONS,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicPermissionSet => PublicPermissionSet::fromArray($data));
    }

    /**
     * List roles
     *
     * Retrieves all roles assignable in the current organization: the built-in roles plus the
     * organization's custom roles
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<PublicRoleDefinition>
     */
    public function listRoles(?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_ROLES,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): PublicRoleDefinition => PublicRoleDefinition::fromArray($item), $data));
    }

    /**
     * Create a custom role
     *
     * Creates an organization-owned custom role granting the requested permissions. The escalation-bearing
     * admin/owner permissions cannot be granted.
     *
     * @param CustomRoleCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function createRole(CustomRoleCreate|array $body, ?string $xDatetimeFormat = null): PublicRoleDefinition
    {
        $response = $this->client->request(
            'POST',
            Endpoint::ORGANIZATIONS_ROLES,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicRoleDefinition => PublicRoleDefinition::fromArray($data));
    }

    /**
     * Get a role
     *
     * Retrieves a single role (built-in or custom) by its name
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getRole(string $label, ?string $xDatetimeFormat = null): PublicRoleDefinition
    {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_ROLES_BY_LABEL,
            path: ['label' => $label],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicRoleDefinition => PublicRoleDefinition::fromArray($data));
    }

    /**
     * Update a custom role
     *
     * Updates a custom role's name, description and/or permission set. Permission changes apply to every
     * subject holding the role instantly. Built-in roles are immutable.
     *
     * @param CustomRoleUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function updateRole(
        string $label,
        CustomRoleUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): PublicRoleDefinition {
        $response = $this->client->request(
            'PATCH',
            Endpoint::ORGANIZATIONS_ROLES_BY_LABEL,
            path: ['label' => $label],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicRoleDefinition => PublicRoleDefinition::fromArray($data));
    }

    /**
     * Delete a custom role
     *
     * Deletes a custom role. Refused while the role is still assigned to any subject, and for built-in
     * roles.
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function deleteRole(string $label, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::ORGANIZATIONS_ROLES_BY_LABEL,
            path: ['label' => $label],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * List all users
     *
     * Retrieves a paginated list of users under the current organization
     *
     * Required permissions: organization:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param UserSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param string|null $search Search across username, email, first name, and last name
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listUsers(
        ?int $page = null,
        ?int $pageSize = null,
        UserSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $search = null,
        ?string $xDatetimeFormat = null,
    ): PaginationUserPublicWithRole {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_USERS,
            query: ['page' => $page, 'page_size' => $pageSize, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'search' => $search],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationUserPublicWithRole => PaginationUserPublicWithRole::fromArray($data));
    }

    /**
     * Get organization details
     *
     * Retrieves details for a specific organization
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getOrganization(
        string $organizationId,
        ?string $xDatetimeFormat = null,
    ): OrganizationWithBillingData {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID,
            path: ['organization_id' => $organizationId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): OrganizationWithBillingData => OrganizationWithBillingData::fromArray($data));
    }

    /**
     * Update an organization
     *
     * Updates details for a specific organization. The name, address and tax ID of an organization billed
     * on its own account are changed by support only; changing them returns 403.
     *
     * @param OrganizationUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function updateOrganization(
        string $organizationId,
        OrganizationUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): Organization {
        $response = $this->client->request(
            'PATCH',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID,
            path: ['organization_id' => $organizationId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): Organization => Organization::fromArray($data));
    }

    /**
     * Delete an organization
     *
     * Permanently deletes an organization
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function deleteOrganization(string $organizationId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID,
            path: ['organization_id' => $organizationId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * List organization attributes
     *
     * Retrieves a list of organization attributes for the specified organization
     *
     * Required permissions: organization:read
     *
     * @param list<string>|null $keys Optional list of attribute keys to filter
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<OrganizationAttributeResponse>
     */
    public function getOrganizationAttributes(
        string $organizationId,
        ?array $keys = null,
        ?string $xDatetimeFormat = null,
    ): array {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_ATTRIBUTES,
            path: ['organization_id' => $organizationId],
            query: ['keys' => $keys],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): OrganizationAttributeResponse => OrganizationAttributeResponse::fromArray($item), $data));
    }

    /**
     * Update organization attributes
     *
     * Updates one or more organization attributes for the specified organization. Setting a billing,
     * pricing or abuse notification email requires the organization owner or an admin of a parent
     * organization.
     *
     * @param list<OrganizationAttributeUpdate>|list<array<string, mixed>> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     * @return list<OrganizationAttributeResponse>
     */
    public function updateOrganizationAttributes(
        string $organizationId,
        array $body,
        ?string $xDatetimeFormat = null,
    ): array {
        $response = $this->client->request(
            'PATCH',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_ATTRIBUTES,
            path: ['organization_id' => $organizationId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $item): OrganizationAttributeResponse => OrganizationAttributeResponse::fromArray($item), $data));
    }

    /**
     * List all invoices for the organization
     *
     * Retrieves a paginated list of all invoices for the organization
     *
     * Required permissions: billing:manage
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listInvoices(
        string $organizationId,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): PaginationInvoiceResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_BILLING_INVOICES,
            path: ['organization_id' => $organizationId],
            query: ['page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationInvoiceResponse => PaginationInvoiceResponse::fromArray($data));
    }

    /**
     * List all payment receipts for the organization
     *
     * Retrieves a paginated list of all payment receipts for the organization
     *
     * Required permissions: billing:manage
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listReceipts(
        string $organizationId,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): PaginationInvoiceResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_BILLING_RECEIPTS,
            path: ['organization_id' => $organizationId],
            query: ['page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationInvoiceResponse => PaginationInvoiceResponse::fromArray($data));
    }

    /**
     * List product prices
     *
     * Retrieves pricing data for a specific product type. If a product action/class are specified, only
     * prices for those are returned, if any.
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getPricingPlans(
        string $organizationId,
        BillingTransactionProductType|string $productType,
        BillingTransactionAction|string|null $productAction = null,
        ?string $productClass = null,
        ?string $xDatetimeFormat = null,
    ): GetPricesResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_PRICING_PRODUCT_TYPE_BY_PRODUCT_TYPE,
            path: ['organization_id' => $organizationId, 'product_type' => $productType],
            query: ['product_action' => $productAction, 'product_class' => $productClass],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): GetPricesResponse => GetPricesResponse::fromArray($data));
    }

    /**
     * List all transactions
     *
     * Retrieves a paginated list of transactions for an organization
     *
     * Required permissions: organization:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param BillingTransactionSortField|string|null $sortBy Field to sort by Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order direction Server default: desc.
     * @param string|null $productReference Filter by product reference
     * @param BillingTransactionProductType|string|null $productType Filter by product type
     * @param BillingTransactionAction|string|null $action Filter by action
     * @param BillingTransactionStatus|string|null $status Filter by status
     * @param \DateTimeImmutable|null $createdAfter Filter by transactions created after this date
     * @param \DateTimeImmutable|null $createdBefore Filter by transactions created before this date
     * @param \DateTimeImmutable|null $completedAfter Filter by transactions completed after this date
     * @param \DateTimeImmutable|null $completedBefore Filter by transactions completed before this date
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getTransactions(
        string $organizationId,
        ?int $page = null,
        ?int $pageSize = null,
        BillingTransactionSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $productReference = null,
        BillingTransactionProductType|string|null $productType = null,
        BillingTransactionAction|string|null $action = null,
        BillingTransactionStatus|string|null $status = null,
        ?\DateTimeImmutable $createdAfter = null,
        ?\DateTimeImmutable $createdBefore = null,
        ?\DateTimeImmutable $completedAfter = null,
        ?\DateTimeImmutable $completedBefore = null,
        ?string $xDatetimeFormat = null,
    ): PaginationBillingTransactionResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_TRANSACTIONS,
            path: ['organization_id' => $organizationId],
            query: ['page' => $page, 'page_size' => $pageSize, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'product_reference' => $productReference, 'product_type' => $productType, 'action' => $action, 'status' => $status, 'created_after' => $createdAfter, 'created_before' => $createdBefore, 'completed_after' => $completedAfter, 'completed_before' => $completedBefore],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationBillingTransactionResponse => PaginationBillingTransactionResponse::fromArray($data));
    }

    /**
     * Get a specific transaction
     *
     * Retrieves details for a specific transaction for an organization
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getTransaction(
        string $organizationId,
        string $transactionId,
        ?string $xDatetimeFormat = null,
    ): BillingTransactionResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_TRANSACTIONS_BY_TRANSACTION_ID,
            path: ['organization_id' => $organizationId, 'transaction_id' => $transactionId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): BillingTransactionResponse => BillingTransactionResponse::fromArray($data));
    }

    /**
     * Usage over time
     *
     * Retrieves the organization's usage of a metered product as a time series, bucketed by the requested
     * granularity and grouped per sub-metric. Reports usage quantities only.
     *
     * Required permissions: organization:read
     *
     * @param \DateTimeImmutable $startDate Inclusive start date (YYYY-MM-DD)
     * @param \DateTimeImmutable $endDate Inclusive end date (YYYY-MM-DD)
     * @param UsageGranularity|string|null $granularity Time-bucket size Server default: day.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getUsageSeries(
        string $organizationId,
        UsageProduct|string $product,
        \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate,
        UsageGranularity|string|null $granularity = null,
        ?string $xDatetimeFormat = null,
    ): AiInferenceUsageSeriesResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_USAGE_BY_PRODUCT,
            path: ['organization_id' => $organizationId, 'product' => $product],
            query: ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d'), 'granularity' => $granularity],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): AiInferenceUsageSeriesResponse => AiInferenceUsageSeriesResponse::fromArray($data));
    }

    /**
     * Usage summary
     *
     * Retrieves the organization's total usage of a metered product over a date range, grouped per
     * sub-metric. Reports usage quantities only.
     *
     * Required permissions: organization:read
     *
     * @param \DateTimeImmutable $startDate Inclusive start date (YYYY-MM-DD)
     * @param \DateTimeImmutable $endDate Inclusive end date (YYYY-MM-DD)
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getUsageSummary(
        string $organizationId,
        UsageProduct|string $product,
        \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate,
        ?string $xDatetimeFormat = null,
    ): AiInferenceUsageSummaryResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::ORGANIZATIONS_BY_ORGANIZATION_ID_USAGE_BY_PRODUCT_SUMMARY,
            path: ['organization_id' => $organizationId, 'product' => $product],
            query: ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): AiInferenceUsageSummaryResponse => AiInferenceUsageSummaryResponse::fromArray($data));
    }
}
