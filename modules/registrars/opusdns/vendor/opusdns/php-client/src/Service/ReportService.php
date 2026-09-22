<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\ReportStatus;
use OpusDNS\Client\Enum\ReportTriggerType;
use OpusDNS\Client\Enum\ReportType;
use OpusDNS\Client\Model\CreateReportReq;
use OpusDNS\Client\Model\PublicReportListRes;
use OpusDNS\Client\Model\PublicReportRes;

/**
 * Operations tagged "report".
 */
final class ReportService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List Reports
     *
     * Required permissions: organization:read
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 50.
     * @param list<ReportType|string>|null $reportType
     * @param list<ReportStatus|string>|null $status
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listReports(
        ?int $page = null,
        ?int $pageSize = null,
        ?array $reportType = null,
        ?array $status = null,
        ReportTriggerType|string|null $triggerType = null,
        ?\DateTimeImmutable $createdAfter = null,
        ?\DateTimeImmutable $createdBefore = null,
        ?string $xDatetimeFormat = null,
    ): PublicReportListRes {
        $response = $this->client->request(
            'GET',
            Endpoint::REPORTS,
            query: ['page' => $page, 'page_size' => $pageSize, 'report_type' => $reportType, 'status' => $status, 'trigger_type' => $triggerType, 'created_after' => $createdAfter, 'created_before' => $createdBefore],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicReportListRes => PublicReportListRes::fromArray($data));
    }

    /**
     * Create Report
     *
     * Required permissions: organization:read
     *
     * @param CreateReportReq|array<string, mixed>|null $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createReport(CreateReportReq|array|null $body = null, ?string $xDatetimeFormat = null): mixed
    {
        $response = $this->client->request(
            'POST',
            Endpoint::REPORTS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->decode($response);
    }

    /**
     * Get Report
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getReport(string $reportId, ?string $xDatetimeFormat = null): PublicReportRes
    {
        $response = $this->client->request(
            'GET',
            Endpoint::REPORTS_BY_REPORT_ID,
            path: ['report_id' => $reportId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicReportRes => PublicReportRes::fromArray($data));
    }

    /**
     * Download Report
     *
     * Required permissions: organization:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function downloadReport(string $reportId, ?string $xDatetimeFormat = null): mixed
    {
        $response = $this->client->request(
            'GET',
            Endpoint::REPORTS_BY_REPORT_ID_DOWNLOAD,
            path: ['report_id' => $reportId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->decode($response);
    }
}
