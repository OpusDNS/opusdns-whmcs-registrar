<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ParkingTotalMetricsResponse implements ApiModel
{
    /**
     * @param int $totalCount Total number of parking entries
     * @param ParkingStatistics $totalMetrics Aggregated metrics for all parking entries
     */
    public function __construct(
        public int $totalCount,
        public ParkingStatistics $totalMetrics,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            totalCount: $data['total_count'],
            totalMetrics: ParkingStatistics::fromArray($data['total_metrics']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'total_count' => $this->totalCount,
            'total_metrics' => $this->totalMetrics,
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
