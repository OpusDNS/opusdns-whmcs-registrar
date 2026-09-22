<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class CreateJobBatchResponse implements ApiModel
{
    /**
     * @param string $batchId TypeID identifying this batch TypeID prefix: batch.
     * @param int $jobsCreated Number of jobs successfully created
     * @param int $jobsFailed Number of jobs that failed to create
     * @param string $statusUrl URL to check batch status. May 404 if jobs_created is 0 — see
     *     duplicates[].existing_batch_id for prior batches.
     * @param int $totalCommands Total commands in the batch
     * @param list<DuplicateCommand>|null $duplicates Per-command details for duplicates, including pointers to the
     *     existing jobs/batches
     * @param list<CommandError>|null $errors Details of failed commands
     * @param int $jobsDuplicated Number of commands skipped because their idempotency_key matched a
     *     previously-submitted job
     */
    public function __construct(
        public string $batchId,
        public int $jobsCreated,
        public int $jobsFailed,
        public string $statusUrl,
        public int $totalCommands,
        public ?array $duplicates = null,
        public ?array $errors = null,
        public int $jobsDuplicated = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            batchId: $data['batch_id'],
            jobsCreated: $data['jobs_created'],
            jobsFailed: $data['jobs_failed'],
            statusUrl: $data['status_url'],
            totalCommands: $data['total_commands'],
            duplicates: isset($data['duplicates']) ? array_map(static fn (array $item): DuplicateCommand => DuplicateCommand::fromArray($item), $data['duplicates']) : null,
            errors: isset($data['errors']) ? array_map(static fn (array $item): CommandError => CommandError::fromArray($item), $data['errors']) : null,
            jobsDuplicated: $data['jobs_duplicated'] ?? 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'batch_id' => $this->batchId,
            'jobs_created' => $this->jobsCreated,
            'jobs_failed' => $this->jobsFailed,
            'status_url' => $this->statusUrl,
            'total_commands' => $this->totalCommands,
            'duplicates' => $this->duplicates,
            'errors' => $this->errors,
            'jobs_duplicated' => $this->jobsDuplicated,
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
