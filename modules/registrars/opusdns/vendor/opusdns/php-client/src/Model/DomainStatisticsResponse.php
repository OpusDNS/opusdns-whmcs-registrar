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

final readonly class DomainStatisticsResponse implements ApiModel
{
    /**
     * @param list<DomainStatisticsBreakdownRowResponse> $breakdown Top organizations or TLDs by acquisitions in the
     *     window; empty unless requested
     * @param list<DomainStatisticsBucketResponse> $buckets One entry per bucket the window touches, oldest first,
     *     including empty buckets
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive
     * @param UsageGranularity|string $granularity Time-bucket size of the series
     * @param string $organizationId The organization the counts are scoped to TypeID prefix: organization.
     * @param \DateTimeImmutable $startDate First day of the window, inclusive
     * @param \DateTimeImmutable|null $dataAvailableFrom Oldest day these statistics can report on. They are read
     *     from the domain event log, which starts later than the domains themselves, so a window reaching further
     *     back is empty before this instant rather than zero.
     */
    public function __construct(
        public array $breakdown,
        public array $buckets,
        public \DateTimeImmutable $endDate,
        public UsageGranularity|string $granularity,
        public string $organizationId,
        public \DateTimeImmutable $startDate,
        public DomainStatisticsTotalsResponse $totals,
        public ?\DateTimeImmutable $dataAvailableFrom = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            breakdown: array_map(static fn (array $item): DomainStatisticsBreakdownRowResponse => DomainStatisticsBreakdownRowResponse::fromArray($item), $data['breakdown']),
            buckets: array_map(static fn (array $item): DomainStatisticsBucketResponse => DomainStatisticsBucketResponse::fromArray($item), $data['buckets']),
            endDate: Serializer::parseDate($data['end_date']),
            granularity: UsageGranularity::tryFrom($data['granularity']) ?? $data['granularity'],
            organizationId: $data['organization_id'],
            startDate: Serializer::parseDate($data['start_date']),
            totals: DomainStatisticsTotalsResponse::fromArray($data['totals']),
            dataAvailableFrom: isset($data['data_available_from']) ? new \DateTimeImmutable($data['data_available_from']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'breakdown' => $this->breakdown,
            'buckets' => $this->buckets,
            'end_date' => $this->endDate->format('Y-m-d'),
            'granularity' => $this->granularity,
            'organization_id' => $this->organizationId,
            'start_date' => $this->startDate->format('Y-m-d'),
            'totals' => $this->totals,
            'data_available_from' => $this->dataAvailableFrom,
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
