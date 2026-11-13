<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class JobCountsByStatus implements ApiModel
{
    public function __construct(
        public readonly int $blocked = 0,
        public readonly int $canceled = 0,
        public readonly int $deadLetter = 0,
        public readonly int $failed = 0,
        public readonly int $paused = 0,
        public readonly int $queued = 0,
        public readonly int $running = 0,
        public readonly int $succeeded = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            blocked: $data['blocked'] ?? 0,
            canceled: $data['canceled'] ?? 0,
            deadLetter: $data['dead_letter'] ?? 0,
            failed: $data['failed'] ?? 0,
            paused: $data['paused'] ?? 0,
            queued: $data['queued'] ?? 0,
            running: $data['running'] ?? 0,
            succeeded: $data['succeeded'] ?? 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'blocked' => $this->blocked,
            'canceled' => $this->canceled,
            'dead_letter' => $this->deadLetter,
            'failed' => $this->failed,
            'paused' => $this->paused,
            'queued' => $this->queued,
            'running' => $this->running,
            'succeeded' => $this->succeeded,
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
