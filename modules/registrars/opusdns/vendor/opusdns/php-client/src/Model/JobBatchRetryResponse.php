<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class JobBatchRetryResponse implements ApiModel
{
    /**
     * @param string $batchId TypeID identifying this batch TypeID prefix: batch.
     * @param int $retriedCount Number of FAILED/DEAD_LETTER jobs reset for retry
     * @param int $blockedCount Number of retried jobs held behind the topic rate limit or backlog (BLOCKED)
     * @param int $queuedCount Number of retried jobs dispatched immediately (QUEUED)
     */
    public function __construct(
        public string $batchId,
        public int $retriedCount,
        public int $blockedCount = 0,
        public int $queuedCount = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            batchId: $data['batch_id'],
            retriedCount: $data['retried_count'],
            blockedCount: $data['blocked_count'] ?? 0,
            queuedCount: $data['queued_count'] ?? 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'batch_id' => $this->batchId,
            'retried_count' => $this->retriedCount,
            'blocked_count' => $this->blockedCount,
            'queued_count' => $this->queuedCount,
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
