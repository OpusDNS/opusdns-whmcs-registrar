<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Model\ClearVanityNameserverSetDefaultRes;
use OpusDNS\Client\Model\ListVanityNameserverSetsRes;
use OpusDNS\Client\Model\ListZonesReferencingSetRes;
use OpusDNS\Client\Model\SetRenewalModeReq;
use OpusDNS\Client\Model\SetVanityNameserverSetDefaultRes;
use OpusDNS\Client\Model\VanityNameserverSetCreate;
use OpusDNS\Client\Model\VanityNameserverSetSummaryDTO;
use OpusDNS\Client\Model\VanityNsCheckPublicReq;
use OpusDNS\Client\Model\VanityNsCheckRes;

/**
 * Operations tagged "nameserver".
 */
final class VanityNameserversService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List vanity nameserver sets
     *
     * Required permissions: vanity_ns:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listVanityNameserverSets(
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): ListVanityNameserverSetsRes {
        $response = $this->client->request(
            'GET',
            Endpoint::VANITY_NAMESERVER_SETS,
            query: ['page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ListVanityNameserverSetsRes => ListVanityNameserverSetsRes::fromArray($data));
    }

    /**
     * Create a vanity nameserver set
     *
     * Required permissions: vanity_ns:manage
     *
     * @param VanityNameserverSetCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createVanityNameserverSet(
        VanityNameserverSetCreate|array $body,
        ?string $xDatetimeFormat = null,
    ): VanityNameserverSetSummaryDTO {
        $response = $this->client->request(
            'POST',
            Endpoint::VANITY_NAMESERVER_SETS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): VanityNameserverSetSummaryDTO => VanityNameserverSetSummaryDTO::fromArray($data));
    }

    /**
     * Run a read-only diagnostic on a vanity nameserver set
     *
     * Required permissions: vanity_ns:read
     *
     * @param VanityNsCheckPublicReq|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function checkVanityNameserverSet(
        VanityNsCheckPublicReq|array $body,
        ?string $xDatetimeFormat = null,
    ): VanityNsCheckRes {
        $response = $this->client->request(
            'POST',
            Endpoint::VANITY_NAMESERVER_SETS_CHECK,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): VanityNsCheckRes => VanityNsCheckRes::fromArray($data));
    }

    /**
     * Unset the organization's default vanity nameserver set
     *
     * Required permissions: vanity_ns:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function clearVanityNameserverSetDefault(
        ?string $xDatetimeFormat = null,
    ): ClearVanityNameserverSetDefaultRes {
        $response = $this->client->request(
            'DELETE',
            Endpoint::VANITY_NAMESERVER_SETS_DEFAULT,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ClearVanityNameserverSetDefaultRes => ClearVanityNameserverSetDefaultRes::fromArray($data));
    }

    /**
     * Get a vanity nameserver set
     *
     * Required permissions: vanity_ns:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getVanityNameserverSet(
        string $setId,
        ?string $xDatetimeFormat = null,
    ): VanityNameserverSetSummaryDTO {
        $response = $this->client->request(
            'GET',
            Endpoint::VANITY_NAMESERVER_SETS_BY_SET_ID,
            path: ['set_id' => $setId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): VanityNameserverSetSummaryDTO => VanityNameserverSetSummaryDTO::fromArray($data));
    }

    /**
     * Set the vanity nameserver set's renewal mode (expire = cancel at period end, renew = un-cancel)
     *
     * Required permissions: vanity_ns:manage
     *
     * @param SetRenewalModeReq|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function setVanityNameserverSetRenewalMode(
        string $setId,
        SetRenewalModeReq|array $body,
        ?string $xDatetimeFormat = null,
    ): VanityNameserverSetSummaryDTO {
        $response = $this->client->request(
            'PATCH',
            Endpoint::VANITY_NAMESERVER_SETS_BY_SET_ID,
            path: ['set_id' => $setId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): VanityNameserverSetSummaryDTO => VanityNameserverSetSummaryDTO::fromArray($data));
    }

    /**
     * Delete a vanity nameserver set
     *
     * Required permissions: vanity_ns:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteVanityNameserverSet(string $setId, ?string $xDatetimeFormat = null): mixed
    {
        $response = $this->client->request(
            'DELETE',
            Endpoint::VANITY_NAMESERVER_SETS_BY_SET_ID,
            path: ['set_id' => $setId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->decode($response);
    }

    /**
     * Set a vanity nameserver set as the org default
     *
     * Required permissions: vanity_ns:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function setVanityNameserverSetDefault(
        string $setId,
        ?string $xDatetimeFormat = null,
    ): SetVanityNameserverSetDefaultRes {
        $response = $this->client->request(
            'PATCH',
            Endpoint::VANITY_NAMESERVER_SETS_BY_SET_ID_DEFAULT,
            path: ['set_id' => $setId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): SetVanityNameserverSetDefaultRes => SetVanityNameserverSetDefaultRes::fromArray($data));
    }

    /**
     * Restore a suspended vanity nameserver set
     *
     * Required permissions: vanity_ns:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function restoreVanityNameserverSet(
        string $setId,
        ?string $xDatetimeFormat = null,
    ): VanityNameserverSetSummaryDTO {
        $response = $this->client->request(
            'POST',
            Endpoint::VANITY_NAMESERVER_SETS_BY_SET_ID_RESTORE,
            path: ['set_id' => $setId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): VanityNameserverSetSummaryDTO => VanityNameserverSetSummaryDTO::fromArray($data));
    }

    /**
     * Retry activation for a failed vanity nameserver set
     *
     * Required permissions: vanity_ns:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function retryVanityNameserverSet(
        string $setId,
        ?string $xDatetimeFormat = null,
    ): VanityNameserverSetSummaryDTO {
        $response = $this->client->request(
            'POST',
            Endpoint::VANITY_NAMESERVER_SETS_BY_SET_ID_RETRY,
            path: ['set_id' => $setId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): VanityNameserverSetSummaryDTO => VanityNameserverSetSummaryDTO::fromArray($data));
    }

    /**
     * List DNS zones referencing a vanity nameserver set
     *
     * Required permissions: vanity_ns:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listZonesReferencingVanityNameserverSet(
        string $setId,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): ListZonesReferencingSetRes {
        $response = $this->client->request(
            'GET',
            Endpoint::VANITY_NAMESERVER_SETS_BY_SET_ID_ZONES,
            path: ['set_id' => $setId],
            query: ['page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ListZonesReferencingSetRes => ListZonesReferencingSetRes::fromArray($data));
    }
}
