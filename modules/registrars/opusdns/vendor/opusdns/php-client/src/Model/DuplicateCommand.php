<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DuplicateCommand implements ApiModel
{
    /**
     * @param string $existingJobId ID of the previously-created job whose idempotency_key matched this command
     *     TypeID prefix: job.
     * @param int $index Index of the duplicate command in the request
     * @param string|null $existingBatchId batch_id of the batch the existing job belongs to. Use this with
     *     /v1/jobs/{batch_id} to check status — the batch_id returned at the top level of this response will 404
     *     if no new jobs were created.
     * @param int|null $instanceIndex Index within a bulk command's instances[] for per-instance duplicates
     * @param string|null $resourceKey Resource identifier (zone name, domain name, contact email) for this duplicate
     */
    public function __construct(
        public string $existingJobId,
        public int $index,
        public ?string $existingBatchId = null,
        public ?int $instanceIndex = null,
        public ?string $resourceKey = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            existingJobId: $data['existing_job_id'],
            index: $data['index'],
            existingBatchId: $data['existing_batch_id'] ?? null,
            instanceIndex: $data['instance_index'] ?? null,
            resourceKey: $data['resource_key'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'existing_job_id' => $this->existingJobId,
            'index' => $this->index,
            'existing_batch_id' => $this->existingBatchId,
            'instance_index' => $this->instanceIndex,
            'resource_key' => $this->resourceKey,
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
