<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\EmailForwardSortField;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Model\EmailForwardAlias;
use OpusDNS\Client\Model\EmailForwardAliasCreate;
use OpusDNS\Client\Model\EmailForwardAliasUpdate;
use OpusDNS\Client\Model\EmailForwardCreate;
use OpusDNS\Client\Model\EmailForwardMetrics;
use OpusDNS\Client\Model\EmailForwardResponse;
use OpusDNS\Client\Model\PaginationEmailForwardResponse;

/**
 * Operations tagged "email_forward".
 */
final class EmailForwardService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List all email forwards
     *
     * Retrieves a paginated list of all email forwards for the organization.
     *
     * Required permissions: email_forwards:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param EmailForwardSortField|string|null $sortBy Server default: created_on.
     * @param SortOrder|string|null $sortOrder Server default: desc.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listEmailForwards(
        ?int $page = null,
        ?int $pageSize = null,
        ?string $search = null,
        ?bool $enabled = null,
        EmailForwardSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $xDatetimeFormat = null,
    ): PaginationEmailForwardResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::EMAIL_FORWARDS,
            query: ['page' => $page, 'page_size' => $pageSize, 'search' => $search, 'enabled' => $enabled, 'sort_by' => $sortBy, 'sort_order' => $sortOrder],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationEmailForwardResponse => PaginationEmailForwardResponse::fromArray($data));
    }

    /**
     * Create email forward configuration
     *
     * Creates an email forward configuration with optional aliases. Can be created enabled or disabled
     * (default: disabled). Includes created_on and updated_on timestamps.
     *
     * Required permissions: dns:manage, email_forwards:manage
     *
     * @param EmailForwardCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createEmailForward(
        EmailForwardCreate|array $body,
        ?string $xDatetimeFormat = null,
    ): EmailForwardResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::EMAIL_FORWARDS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): EmailForwardResponse => EmailForwardResponse::fromArray($data));
    }

    /**
     * Get email forward configuration
     *
     * Retrieves the email forward configuration for the specified email forward including all aliases
     *
     * Required permissions: email_forwards:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getEmailForward(string $emailForwardId, ?string $xDatetimeFormat = null): EmailForwardResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID,
            path: ['email_forward_id' => $emailForwardId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): EmailForwardResponse => EmailForwardResponse::fromArray($data));
    }

    /**
     * Delete email forward configuration
     *
     * Permanently deletes the email forward configuration including all aliases. If enabled, automatically
     * disables first (removes DNS records and unregisters from the email forwarding provider).
     *
     * Required permissions: email_forwards:delete
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteEmailForward(string $emailForwardId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID,
            path: ['email_forward_id' => $emailForwardId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Create email forward alias
     *
     * Creates a new email forward alias for the specified email forward. Use '*' as the alias name to
     * configure a catch-all alias that forwards all unmatched emails for the domain.
     *
     * Required permissions: email_forwards:manage
     *
     * @param EmailForwardAliasCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createEmailForwardAlias(
        string $emailForwardId,
        EmailForwardAliasCreate|array $body,
        ?string $xDatetimeFormat = null,
    ): EmailForwardAlias {
        $response = $this->client->request(
            'POST',
            Endpoint::EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_ALIASES,
            path: ['email_forward_id' => $emailForwardId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): EmailForwardAlias => EmailForwardAlias::fromArray($data));
    }

    /**
     * Update email forward alias
     *
     * Updates the forward_to address for a specific email forward alias specified by
     * email_forward_alias_id
     *
     * Required permissions: email_forwards:manage
     *
     * @param EmailForwardAliasUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function updateEmailForwardAlias(
        string $emailForwardId,
        string $aliasId,
        EmailForwardAliasUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): EmailForwardAlias {
        $response = $this->client->request(
            'PUT',
            Endpoint::EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_ALIASES_BY_ALIAS_ID,
            path: ['email_forward_id' => $emailForwardId, 'alias_id' => $aliasId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): EmailForwardAlias => EmailForwardAlias::fromArray($data));
    }

    /**
     * Delete email forward alias
     *
     * Deletes a specific email forward alias specified by email_forward_alias_id for the specified email
     * forward
     *
     * Required permissions: email_forwards:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteEmailForwardAlias(
        string $emailForwardId,
        string $aliasId,
        ?string $xDatetimeFormat = null,
    ): void {
        $this->client->request(
            'DELETE',
            Endpoint::EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_ALIASES_BY_ALIAS_ID,
            path: ['email_forward_id' => $emailForwardId, 'alias_id' => $aliasId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Disable email forwarding
     *
     * Disables email forwarding by removing MX and SPF DNS records and unregistering the domain from the
     * email forwarding provider. The email forward configuration is preserved but disabled.
     *
     * Required permissions: email_forwards:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function disableEmailForward(string $emailForwardId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'PATCH',
            Endpoint::EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_DISABLE,
            path: ['email_forward_id' => $emailForwardId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Enable email forwarding
     *
     * Enables email forwarding by creating necessary MX and SPF DNS records and registering the domain
     * with the email forwarding provider.
     *
     * Required permissions: email_forwards:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function enableEmailForward(string $emailForwardId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'PATCH',
            Endpoint::EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_ENABLE,
            path: ['email_forward_id' => $emailForwardId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Retrieve email forward metrics
     *
     * Retrieves metrics and statistics for a specific email forward, including delivery rates and status
     * counts.
     *
     * Required permissions: email_forwards:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getEmailForwardMetrics(
        string $emailForwardId,
        ?\DateTimeImmutable $startTime = null,
        ?\DateTimeImmutable $endTime = null,
        ?string $xDatetimeFormat = null,
    ): EmailForwardMetrics {
        $response = $this->client->request(
            'GET',
            Endpoint::EMAIL_FORWARDS_BY_EMAIL_FORWARD_ID_METRICS,
            path: ['email_forward_id' => $emailForwardId],
            query: ['start_time' => $startTime, 'end_time' => $endTime],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): EmailForwardMetrics => EmailForwardMetrics::fromArray($data));
    }
}
