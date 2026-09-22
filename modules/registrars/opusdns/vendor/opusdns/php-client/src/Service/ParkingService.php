<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\ComplianceStatus;
use OpusDNS\Client\Enum\ParkingSortField;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Model\PageResponseParkingResponse;
use OpusDNS\Client\Model\ParkingMetricsResponse;
use OpusDNS\Client\Model\ParkingSignupRequest;
use OpusDNS\Client\Model\ParkingSignupResponse;
use OpusDNS\Client\Model\ParkingSignupStatusResponse;
use OpusDNS\Client\Model\ParkingTotalMetricsResponse;

/**
 * Operations tagged "parking".
 */
final class ParkingService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List parking entries
     *
     * Retrieves a paginated list of parking entries for the organization
     *
     * Required permissions: parking:read
     *
     * @param int|null $page Page number Server default: 1.
     * @param int|null $pageSize Page size Server default: 10.
     * @param ParkingSortField|string|null $sortBy Server default: created_on.
     * @param SortOrder|string|null $sortOrder Server default: desc.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listParking(
        ?int $page = null,
        ?int $pageSize = null,
        ParkingSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?string $search = null,
        ?bool $enabled = null,
        ComplianceStatus|string|null $complianceStatus = null,
        ?string $xDatetimeFormat = null,
    ): PageResponseParkingResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::PARKING,
            query: ['page' => $page, 'page_size' => $pageSize, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'search' => $search, 'enabled' => $enabled, 'compliance_status' => $complianceStatus],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PageResponseParkingResponse => PageResponseParkingResponse::fromArray($data));
    }

    /**
     * Get total metrics for all parking entries
     *
     * Retrieves aggregated metrics for all parking entries of the organization.
     *
     * Required permissions: parking:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getTotalParkingMetrics(
        ?\DateTimeImmutable $startTime = null,
        ?\DateTimeImmutable $endTime = null,
        ?string $xDatetimeFormat = null,
    ): ParkingTotalMetricsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::PARKING_METRICS,
            query: ['start_time' => $startTime, 'end_time' => $endTime],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ParkingTotalMetricsResponse => ParkingTotalMetricsResponse::fromArray($data));
    }

    /**
     * Sign up for parking
     *
     * Accept the parking agreement to enable parking features for your organization.
     *
     * Required permissions: parking:manage
     *
     * @param ParkingSignupRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function signupForParking(
        ParkingSignupRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): ParkingSignupResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::PARKING_SIGNUP,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ParkingSignupResponse => ParkingSignupResponse::fromArray($data));
    }

    /**
     * Get parking signup status
     *
     * Check if your organization has accepted the parking agreement.
     *
     * Required permissions: parking:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getParkingSignupStatus(?string $xDatetimeFormat = null): ParkingSignupStatusResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::PARKING_SIGNUP_STATUS,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ParkingSignupStatusResponse => ParkingSignupStatusResponse::fromArray($data));
    }

    /**
     * Get metrics for a parking entry
     *
     * Retrieves metrics for a specific parking entry by ID or domain name.
     *
     * Required permissions: parking:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getParkingMetrics(
        string $parkingReference,
        ?\DateTimeImmutable $startTime = null,
        ?\DateTimeImmutable $endTime = null,
        ?string $xDatetimeFormat = null,
    ): ParkingMetricsResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::PARKING_BY_PARKING_REFERENCE_METRICS,
            path: ['parking_reference' => $parkingReference],
            query: ['start_time' => $startTime, 'end_time' => $endTime],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ParkingMetricsResponse => ParkingMetricsResponse::fromArray($data));
    }
}
