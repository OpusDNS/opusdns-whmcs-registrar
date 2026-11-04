<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnsMoverDirection;
use OpusDNS\Client\Enum\DnsMoversPeriod;
use OpusDNS\Client\Serializer;

final readonly class DnsZoneMoversResponse implements ApiModel
{
    /**
     * @param DnsMoverDirection|string $direction Whether the list shows drops or rises
     * @param DnsMoversPeriod|string $period The period compared with the one before it
     * @param \DateTimeImmutable $periodEnd Last day of the period: the newest day with data
     * @param \DateTimeImmutable $periodStart First day of the period (UTC)
     * @param \DateTimeImmutable $previousPeriodEnd Last day of the period compared with
     * @param \DateTimeImmutable $previousPeriodStart First day of the period compared with
     * @param list<DnsZoneMoverResponse> $results
     * @param \DateTimeImmutable $statisticsUpdatedAt When these numbers were computed. They are recomputed after
     *     each new day of data and after zones changed owner or were deleted, so a change can take a few hours to
     *     show
     */
    public function __construct(
        public DnsMoverDirection|string $direction,
        public DnsMoversPeriod|string $period,
        public \DateTimeImmutable $periodEnd,
        public \DateTimeImmutable $periodStart,
        public \DateTimeImmutable $previousPeriodEnd,
        public \DateTimeImmutable $previousPeriodStart,
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
            direction: DnsMoverDirection::tryFrom($data['direction']) ?? $data['direction'],
            period: DnsMoversPeriod::tryFrom($data['period']) ?? $data['period'],
            periodEnd: Serializer::parseDate($data['period_end']),
            periodStart: Serializer::parseDate($data['period_start']),
            previousPeriodEnd: Serializer::parseDate($data['previous_period_end']),
            previousPeriodStart: Serializer::parseDate($data['previous_period_start']),
            results: array_map(static fn (array $item): DnsZoneMoverResponse => DnsZoneMoverResponse::fromArray($item), $data['results']),
            statisticsUpdatedAt: new \DateTimeImmutable($data['statistics_updated_at']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'direction' => $this->direction,
            'period' => $this->period,
            'period_end' => $this->periodEnd->format('Y-m-d'),
            'period_start' => $this->periodStart->format('Y-m-d'),
            'previous_period_end' => $this->previousPeriodEnd->format('Y-m-d'),
            'previous_period_start' => $this->previousPeriodStart->format('Y-m-d'),
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
