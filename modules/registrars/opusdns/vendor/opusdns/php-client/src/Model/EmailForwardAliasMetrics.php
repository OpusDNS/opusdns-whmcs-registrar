<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardAliasMetrics implements ApiModel
{
    /**
     * @param string $alias Email alias address
     * @param array<string, int> $byStatus Log counts grouped by status
     * @param int $totalLogs Total number of logs for this alias
     */
    public function __construct(
        public string $alias,
        public array $byStatus,
        public int $totalLogs,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            alias: $data['alias'],
            byStatus: (array) $data['by_status'],
            totalLogs: $data['total_logs'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'alias' => $this->alias,
            'by_status' => ($this->byStatus === [] ? new \stdClass() : $this->byStatus),
            'total_logs' => $this->totalLogs,
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
