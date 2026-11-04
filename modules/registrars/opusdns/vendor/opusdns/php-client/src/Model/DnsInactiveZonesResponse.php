<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnsStatisticsPeriod;
use OpusDNS\Client\Serializer;

final readonly class DnsInactiveZonesResponse implements ApiModel
{
    /**
     * @param DnsStatisticsPeriod|string $period The period without queries
     * @param \DateTimeImmutable $periodEnd Last day of the period: the newest day with data
     * @param \DateTimeImmutable $periodStart First day of the period (UTC)
     * @param list<DnsZoneActivityResponse> $results
     * @param \DateTimeImmutable $statisticsUpdatedAt When these numbers were computed. They are recomputed after
     *     each new day of data and after zones changed owner or were deleted, so a change can take a few hours to
     *     show
     */
    public function __construct(
        public PaginationMetadata $pagination,
        public DnsStatisticsPeriod|string $period,
        public \DateTimeImmutable $periodEnd,
        public \DateTimeImmutable $periodStart,
        public array $results,
        public \DateTimeImmutable $statisticsUpdatedAt,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            pagination: PaginationMetadata::fromArray($data['pagination']),
            period: DnsStatisticsPeriod::tryFrom($data['period']) ?? $data['period'],
            periodEnd: Serializer::parseDate($data['period_end']),
            periodStart: Serializer::parseDate($data['period_start']),
            results: array_map(static fn (array $item): DnsZoneActivityResponse => DnsZoneActivityResponse::fromArray($item), $data['results']),
            statisticsUpdatedAt: new \DateTimeImmutable($data['statistics_updated_at']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'pagination' => $this->pagination,
            'period' => $this->period,
            'period_end' => $this->periodEnd->format('Y-m-d'),
            'period_start' => $this->periodStart->format('Y-m-d'),
            'results' => $this->results,
            'statistics_updated_at' => $this->statisticsUpdatedAt,
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
