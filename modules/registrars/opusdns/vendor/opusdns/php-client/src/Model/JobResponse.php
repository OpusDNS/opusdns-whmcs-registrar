<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\JobStatus;
use OpusDNS\Client\Serializer;
use OpusDNS\Client\Union;

final readonly class JobResponse implements ApiModel
{
    /**
     * @param int $attempts Number of execution attempts made for this job
     * @param \DateTimeImmutable $createdOn Timestamp when the job was created (UTC)
     * @param string $jobId Unique identifier for this individual job TypeID prefix: job.
     * @param JobStatus|string $status Current job status: blocked, queued, paused, running, succeeded, failed,
     *     canceled, or dead_letter
     * @param string|null $command Command name (e.g., 'domain_create', 'dns_zone_update')
     * @param string|null $display Human-readable description of this job
     * @param string|null $domainName Domain name associated with this job
     * @param string|null $errorClass Error type if the job failed (e.g., ValidationError, TimeoutError)
     * @param string|null $errorCode Stable semantic error code propagated verbatim from the failing upstream service
     *     (e.g. 'ERROR_DOMAIN_TRANSFER_INVALID_AUTH_CODE'). Suitable for i18n / per-error UI branching. Null when
     *     the job did not fail or the upstream error did not carry a code.
     * @param array<string, mixed>|null $errorDetails Full upstream problem-details payload (RFC 9457) preserved
     *     verbatim — e.g. type/title/status/code/detail plus service-specific extras like domain_name, reason.
     *     Null when the failure didn't originate from a typed upstream response.
     * @param string|null $errorMessage Detailed error message if the job failed
     * @param \DateTimeImmutable|null $finishedAt Timestamp when job execution completed (UTC)
     * @param string|null $operation Operation type (e.g., 'create', 'update', 'transfer')
     * @param \DateTimeImmutable|null $pausedAt Timestamp when job was paused (UTC)
     * @param DomainCreateWorkerPayload|DomainUpdateWorkerPayload|DomainTransferWorkerPayload|DnsZoneCreateWorkerPayload|DnsZoneUpdateWorkerPayload|DnsZonePatchRrsetsWorkerPayload|DnsZonePatchRecordsWorkerPayload|DnsZoneRestampVanityNsWorkerPayload|ContactCreateWorkerPayload|ParkingCreateWorkerPayload|ParkingEnableWorkerPayload|ParkingDisableWorkerPayload|ParkingDeleteWorkerPayload|array<string, mixed>|null $payload The original request payload for this
     *     job
     * @param string|null $resourceKey Resource identifier for this job
     * @param ContactCreateWorkerResult|DomainCreateWorkerResult|DnsZoneCreateWorkerResult|array<string, mixed>|null $result Structured result data from successful
     *     job execution (e.g. created entity IDs). Typed when the worker emits a known `type` discriminator; raw
     *     dict otherwise.
     * @param \DateTimeImmutable|null $startedAt Timestamp when job execution began (UTC)
     */
    public function __construct(
        public int $attempts,
        public \DateTimeImmutable $createdOn,
        public string $jobId,
        public JobStatus|string $status,
        public ?string $command = null,
        public ?string $display = null,
        public ?string $domainName = null,
        public ?string $errorClass = null,
        public ?string $errorCode = null,
        public ?array $errorDetails = null,
        public ?string $errorMessage = null,
        public ?\DateTimeImmutable $finishedAt = null,
        public ?string $operation = null,
        public ?\DateTimeImmutable $pausedAt = null,
        public DomainCreateWorkerPayload|DomainUpdateWorkerPayload|DomainTransferWorkerPayload|DnsZoneCreateWorkerPayload|DnsZoneUpdateWorkerPayload|DnsZonePatchRrsetsWorkerPayload|DnsZonePatchRecordsWorkerPayload|DnsZoneRestampVanityNsWorkerPayload|ContactCreateWorkerPayload|ParkingCreateWorkerPayload|ParkingEnableWorkerPayload|ParkingDisableWorkerPayload|ParkingDeleteWorkerPayload|array|null $payload = null,
        public ?string $resourceKey = null,
        public ContactCreateWorkerResult|DomainCreateWorkerResult|DnsZoneCreateWorkerResult|array|null $result = null,
        public ?\DateTimeImmutable $startedAt = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            attempts: $data['attempts'],
            createdOn: new \DateTimeImmutable($data['created_on']),
            jobId: $data['job_id'],
            status: JobStatus::tryFrom($data['status']) ?? $data['status'],
            command: $data['command'] ?? null,
            display: $data['display'] ?? null,
            domainName: $data['domain_name'] ?? null,
            errorClass: $data['error_class'] ?? null,
            errorCode: $data['error_code'] ?? null,
            errorDetails: isset($data['error_details']) ? (array) $data['error_details'] : null,
            errorMessage: $data['error_message'] ?? null,
            finishedAt: isset($data['finished_at']) ? new \DateTimeImmutable($data['finished_at']) : null,
            operation: $data['operation'] ?? null,
            pausedAt: isset($data['paused_at']) ? new \DateTimeImmutable($data['paused_at']) : null,
            payload: $data['payload'] ?? null,
            resourceKey: $data['resource_key'] ?? null,
            result: $data['result'] ?? null,
            startedAt: isset($data['started_at']) ? new \DateTimeImmutable($data['started_at']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'attempts' => $this->attempts,
            'created_on' => $this->createdOn,
            'job_id' => $this->jobId,
            'status' => $this->status,
            'command' => $this->command,
            'display' => $this->display,
            'domain_name' => $this->domainName,
            'error_class' => $this->errorClass,
            'error_code' => $this->errorCode,
            'error_details' => $this->errorDetails === null ? null : ($this->errorDetails === [] ? new \stdClass() : $this->errorDetails),
            'error_message' => $this->errorMessage,
            'finished_at' => $this->finishedAt,
            'operation' => $this->operation,
            'paused_at' => $this->pausedAt,
            'payload' => $this->payload,
            'resource_key' => $this->resourceKey,
            'result' => $this->result,
            'started_at' => $this->startedAt,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
