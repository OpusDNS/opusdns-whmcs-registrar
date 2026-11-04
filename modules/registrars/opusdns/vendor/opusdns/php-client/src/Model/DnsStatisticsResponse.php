<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\UsageGranularity;
use OpusDNS\Client\Serializer;

final readonly class DnsStatisticsResponse implements ApiModel
{
    /**
     * @param list<DnsStatisticsBucketResponse> $buckets One entry per bucket the window touches, oldest first,
     *     including buckets without queries (0) and buckets without data (null)
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive
     * @param UsageGranularity|string $granularity Time-bucket size of the series
     * @param \DateTimeImmutable $startDate First day of the window, inclusive
     * @param \DateTimeImmutable $statisticsUpdatedAt When these numbers were computed. They are recomputed after
     *     each new day of data and after zones changed owner or were deleted, so a change can take a few hours to
     *     show
     * @param \DateTimeImmutable|null $dataAvailableFrom First day the statistics hold data for. Buckets count no day
     *     before it; one left without a day to count carries null counts. Null while no statistics have been
     *     collected; then every bucket carries null counts. At `granularity=month`, once the daily statistics older
     *     than 25 months have been deleted, it is the first day of the oldest month the monthly statistics hold; the
     *     day the data starts on within that month is no longer known.
     * @param \DateTimeImmutable|null $dataAvailableTo Last day the statistics hold data for. Buckets count no day
     *     after it; one left without a day to count carries null counts. Null while no statistics have been
     *     collected.
     */
    public function __construct(
        public array $buckets,
        public \DateTimeImmutable $endDate,
        public UsageGranularity|string $granularity,
        public \DateTimeImmutable $startDate,
        public \DateTimeImmutable $statisticsUpdatedAt,
        public DnsStatisticsTotalsResponse $totals,
        public ?\DateTimeImmutable $dataAvailableFrom = null,
        public ?\DateTimeImmutable $dataAvailableTo = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            buckets: array_map(static fn (array $item): DnsStatisticsBucketResponse => DnsStatisticsBucketResponse::fromArray($item), $data['buckets']),
            endDate: Serializer::parseDate($data['end_date']),
            granularity: UsageGranularity::tryFrom($data['granularity']) ?? $data['granularity'],
            startDate: Serializer::parseDate($data['start_date']),
            statisticsUpdatedAt: new \DateTimeImmutable($data['statistics_updated_at']),
            totals: DnsStatisticsTotalsResponse::fromArray($data['totals']),
            dataAvailableFrom: isset($data['data_available_from']) ? Serializer::parseDate($data['data_available_from']) : null,
            dataAvailableTo: isset($data['data_available_to']) ? Serializer::parseDate($data['data_available_to']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'buckets' => $this->buckets,
            'end_date' => $this->endDate->format('Y-m-d'),
            'granularity' => $this->granularity,
            'start_date' => $this->startDate->format('Y-m-d'),
            'statistics_updated_at' => $this->statisticsUpdatedAt,
            'totals' => $this->totals,
            'data_available_from' => $this->dataAvailableFrom === null ? null : $this->dataAvailableFrom->format('Y-m-d'),
            'data_available_to' => $this->dataAvailableTo === null ? null : $this->dataAvailableTo->format('Y-m-d'),
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
