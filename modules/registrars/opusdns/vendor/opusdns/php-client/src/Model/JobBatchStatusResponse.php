<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class JobBatchStatusResponse implements ApiModel
{
    /**
     * @param string $batchId TypeID identifying this batch. All jobs in a batch share the same batch_id, while each
     *     job has its own unique job_id. TypeID prefix: batch.
     * @param int $canceled Number of jobs that were canceled
     * @param int $deadLetter Number of jobs that permanently failed after exhausting retries
     * @param int $failed Number of jobs that failed execution
     * @param float $progressPercentage Percentage of jobs in a terminal state (succeeded, failed, canceled, or
     *     dead_letter), 0-100
     * @param int $queued Number of jobs awaiting processing
     * @param int $running Number of jobs currently being executed
     * @param int $succeeded Number of jobs that completed successfully
     * @param int $total Total number of jobs in the batch
     * @param int $blocked Number of jobs waiting for eligibility (scheduled, serial blocked, or no tokens)
     * @param string|null $label Human-readable label for this batch
     * @param int $paused Number of jobs in paused state
     */
    public function __construct(
        public string $batchId,
        public int $canceled,
        public int $deadLetter,
        public int $failed,
        public float $progressPercentage,
        public int $queued,
        public int $running,
        public int $succeeded,
        public int $total,
        public int $blocked = 0,
        public ?string $label = null,
        public int $paused = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            batchId: $data['batch_id'],
            canceled: $data['canceled'],
            deadLetter: $data['dead_letter'],
            failed: $data['failed'],
            progressPercentage: $data['progress_percentage'],
            queued: $data['queued'],
            running: $data['running'],
            succeeded: $data['succeeded'],
            total: $data['total'],
            blocked: $data['blocked'] ?? 0,
            label: $data['label'] ?? null,
            paused: $data['paused'] ?? 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'batch_id' => $this->batchId,
            'canceled' => $this->canceled,
            'dead_letter' => $this->deadLetter,
            'failed' => $this->failed,
            'progress_percentage' => $this->progressPercentage,
            'queued' => $this->queued,
            'running' => $this->running,
            'succeeded' => $this->succeeded,
            'total' => $this->total,
            'blocked' => $this->blocked,
            'label' => $this->label,
            'paused' => $this->paused,
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
