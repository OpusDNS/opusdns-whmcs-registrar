<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\BatchStatus;
use OpusDNS\Client\Serializer;

final readonly class JobBatchMetadataResponse implements ApiModel
{
    /**
     * @param string $batchId TypeID identifying this batch TypeID prefix: batch.
     * @param \DateTimeImmutable $createdOn Timestamp when the batch was created (UTC)
     * @param JobCountsByStatus $jobCounts Number of jobs in each status
     * @param BatchStatus|string $status Batch status: pending (jobs still processing) or complete (all done)
     * @param int $totalJobs Total number of jobs in this batch
     * @param \DateTimeImmutable|null $finishedAt Timestamp when the last job finished (UTC)
     * @param string|null $label Human-readable label for this batch
     * @param \DateTimeImmutable|null $startedAt Timestamp when the first job started (UTC)
     */
    public function __construct(
        public string $batchId,
        public \DateTimeImmutable $createdOn,
        public JobCountsByStatus $jobCounts,
        public BatchStatus|string $status,
        public int $totalJobs,
        public ?\DateTimeImmutable $finishedAt = null,
        public ?string $label = null,
        public ?\DateTimeImmutable $startedAt = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            batchId: $data['batch_id'],
            createdOn: new \DateTimeImmutable($data['created_on']),
            jobCounts: JobCountsByStatus::fromArray($data['job_counts']),
            status: BatchStatus::tryFrom($data['status']) ?? $data['status'],
            totalJobs: $data['total_jobs'],
            finishedAt: isset($data['finished_at']) ? new \DateTimeImmutable($data['finished_at']) : null,
            label: $data['label'] ?? null,
            startedAt: isset($data['started_at']) ? new \DateTimeImmutable($data['started_at']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'batch_id' => $this->batchId,
            'created_on' => $this->createdOn,
            'job_counts' => $this->jobCounts,
            'status' => $this->status,
            'total_jobs' => $this->totalJobs,
            'finished_at' => $this->finishedAt,
            'label' => $this->label,
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
