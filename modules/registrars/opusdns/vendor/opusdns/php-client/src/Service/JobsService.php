<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\BatchSortField;
use OpusDNS\Client\Enum\BatchStatus;
use OpusDNS\Client\Enum\JobStatus;
use OpusDNS\Client\Enum\SortOrder;
use OpusDNS\Client\Model\CreateJobBatchResponse;
use OpusDNS\Client\Model\JobBatchRequest;
use OpusDNS\Client\Model\JobBatchRetryResponse;
use OpusDNS\Client\Model\JobBatchStatusResponse;
use OpusDNS\Client\Model\JobResponse;
use OpusDNS\Client\Model\PageResponseJobBatchMetadataResponse;
use OpusDNS\Client\Model\PageResponseJobResponse;

/**
 * Operations tagged "jobs".
 */
final class JobsService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Get individual job details
     *
     * Required permissions: jobs:read
     *
     * @param string $jobId Job ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getJob(string $jobId, ?string $xDatetimeFormat = null): JobResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::JOB_BY_JOB_ID,
            path: ['job_id' => $jobId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): JobResponse => JobResponse::fromArray($data));
    }

    /**
     * Delete (cancel) a queued job
     *
     * Required permissions: jobs:manage
     *
     * @param string $jobId Job ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteJob(string $jobId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::JOB_BY_JOB_ID,
            path: ['job_id' => $jobId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Pause a job
     *
     * Required permissions: jobs:manage
     *
     * @param string $jobId Job ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function pauseJob(string $jobId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'POST',
            Endpoint::JOB_BY_JOB_ID_PAUSE,
            path: ['job_id' => $jobId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Resume a paused job
     *
     * Required permissions: jobs:manage
     *
     * @param string $jobId Job ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function resumeJob(string $jobId, ?string $xDatetimeFormat = null): JobResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::JOB_BY_JOB_ID_RESUME,
            path: ['job_id' => $jobId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): JobResponse => JobResponse::fromArray($data));
    }

    /**
     * Retry a failed or dead-lettered job
     *
     * Required permissions: jobs:manage
     *
     * @param string $jobId Job ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function retryJob(string $jobId, ?string $xDatetimeFormat = null): JobResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::JOB_BY_JOB_ID_RETRY,
            path: ['job_id' => $jobId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): JobResponse => JobResponse::fromArray($data));
    }

    /**
     * List batches for organization
     *
     * Required permissions: jobs:read
     *
     * @param BatchStatus|string|null $status Filter by batch status (pending or complete)
     * @param BatchSortField|string|null $sortBy Sort field Server default: created_on.
     * @param SortOrder|string|null $sortOrder Sort order Server default: desc.
     * @param int|null $page Page number (1-indexed) Server default: 1.
     * @param int|null $pageSize Number of batches per page Server default: 50.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listBatches(
        BatchStatus|string|null $status = null,
        BatchSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): PageResponseJobBatchMetadataResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::JOBS,
            query: ['status' => $status, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PageResponseJobBatchMetadataResponse => PageResponseJobBatchMetadataResponse::fromArray($data));
    }

    /**
     * Create a batch of commands for async execution
     *
     * Required permissions: contacts:manage, dns:manage, domains:manage, jobs:manage, parking:manage, vanity_ns:manage
     *
     * @param JobBatchRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createBatch(JobBatchRequest|array $body, ?string $xDatetimeFormat = null): CreateJobBatchResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::JOBS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): CreateJobBatchResponse => CreateJobBatchResponse::fromArray($data));
    }

    /**
     * Get batch details and execution status
     *
     * Required permissions: jobs:read
     *
     * @param string $batchId Batch ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getBatch(string $batchId, ?string $xDatetimeFormat = null): JobBatchStatusResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::JOBS_BY_BATCH_ID,
            path: ['batch_id' => $batchId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): JobBatchStatusResponse => JobBatchStatusResponse::fromArray($data));
    }

    /**
     * Delete (cancel) all queued jobs in a batch
     *
     * Required permissions: jobs:manage
     *
     * @param string $batchId Batch ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteBatch(string $batchId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::JOBS_BY_BATCH_ID,
            path: ['batch_id' => $batchId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Get individual jobs within a batch
     *
     * Required permissions: jobs:read
     *
     * @param string $batchId Batch ID
     * @param list<JobStatus|string>|null $status Filter by job status (repeatable)
     * @param BatchSortField|string|null $sortBy Sort field
     * @param SortOrder|string|null $sortOrder Sort order
     * @param int|null $page Page number (1-indexed) Server default: 1.
     * @param int|null $pageSize Number of jobs per page Server default: 100.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getBatchJobs(
        string $batchId,
        ?array $status = null,
        BatchSortField|string|null $sortBy = null,
        SortOrder|string|null $sortOrder = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): PageResponseJobResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::JOBS_BY_BATCH_ID_JOBS,
            path: ['batch_id' => $batchId],
            query: ['status' => $status, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PageResponseJobResponse => PageResponseJobResponse::fromArray($data));
    }

    /**
     * Pause all eligible jobs in a batch
     *
     * Required permissions: jobs:manage
     *
     * @param string $batchId Batch ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function pauseBatch(string $batchId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'POST',
            Endpoint::JOBS_BY_BATCH_ID_PAUSE,
            path: ['batch_id' => $batchId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Resume all paused jobs in a batch
     *
     * Required permissions: jobs:manage
     *
     * @param string $batchId Batch ID
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function resumeBatch(string $batchId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'POST',
            Endpoint::JOBS_BY_BATCH_ID_RESUME,
            path: ['batch_id' => $batchId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Retry failed and dead-lettered jobs in a batch
     *
     * Required permissions: jobs:manage
     *
     * @param string $batchId Batch ID
     * @param list<string>|null $errorClass Optional repeatable filter: only retry jobs whose error_class matches one
     *     of these values. Example: `?error_class=BillingInsufficientFundsError` to retry only insufficient-funds
     *     failures. Omit to retry all failed/dead-lettered jobs in the batch.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function retryBatch(
        string $batchId,
        ?array $errorClass = null,
        ?string $xDatetimeFormat = null,
    ): JobBatchRetryResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::JOBS_BY_BATCH_ID_RETRY,
            path: ['batch_id' => $batchId],
            query: ['error_class' => $errorClass],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): JobBatchRetryResponse => JobBatchRetryResponse::fromArray($data));
    }
}
