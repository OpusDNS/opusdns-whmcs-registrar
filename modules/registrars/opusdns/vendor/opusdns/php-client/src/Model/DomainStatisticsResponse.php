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

final class DomainStatisticsResponse implements ApiModel
{
    /**
     * @param list<DomainStatisticsBreakdownRowResponse> $breakdown Top organizations or TLDs by acquisitions in the
     *     window; empty unless requested
     * @param list<DomainStatisticsBucketResponse> $buckets One entry per bucket the window touches, oldest first,
     *     including buckets without movement (0) and buckets without data (null)
     * @param \DateTimeImmutable $dataAvailableTo When the domain event log was read: the counts include the
     *     movements logged up to about this instant. Buckets count no day after the day of this instant. If the
     *     window reaches that day, its bucket is partial, because the day is still running.
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive
     * @param UsageGranularity|string $granularity Time-bucket size of the series
     * @param string $organizationId The organization the counts are scoped to TypeID prefix: organization.
     * @param \DateTimeImmutable $startDate First day of the window, inclusive
     * @param \DateTimeImmutable|null $dataAvailableFrom Oldest event the domain event log holds, which starts later
     *     than the domains themselves. Buckets count no day before its day; one left without a day to count carries
     *     null counts. Null when the log holds no event or its start could not be read; buckets are then counted
     *     over the whole window.
     */
    public function __construct(
        public readonly array $breakdown,
        public readonly array $buckets,
        public readonly \DateTimeImmutable $dataAvailableTo,
        public readonly \DateTimeImmutable $endDate,
        public readonly UsageGranularity|string $granularity,
        public readonly string $organizationId,
        public readonly \DateTimeImmutable $startDate,
        public readonly DomainStatisticsTotalsResponse $totals,
        public readonly ?\DateTimeImmutable $dataAvailableFrom = null,
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
            dataAvailableTo: new \DateTimeImmutable($data['data_available_to']),
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
            'data_available_to' => $this->dataAvailableTo,
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
