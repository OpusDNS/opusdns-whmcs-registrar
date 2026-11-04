<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ZoneStatisticsBucketResponse implements ApiModel
{
    /**
     * @param bool $partial True when the counts are not those of the whole bucket: `covered_from`..`covered_to` is
     *     shorter than `period_start`..`period_end` because the window or the stored data cuts it, or the bucket is
     *     the first month of monthly statistics older than the daily ones (see `data_available_from`), whose first
     *     day of data is not known. Also true for a bucket that is not covered, which has no counts. A partial
     *     bucket must not be read as a rise or fall against its neighbours. Also true when `covered_from` is the day
     *     the zone was created: that day is counted whole, with the queries from before the zone existed
     * @param \DateTimeImmutable $periodEnd Last day of the bucket (UTC): the day itself, the Sunday of its week, or
     *     the last day of its month
     * @param \DateTimeImmutable $periodStart First day of the bucket (UTC)
     * @param \DateTimeImmutable|null $coveredFrom First day the bucket's counts include: the latest of
     *     `period_start`, `start_date` and `data_available_from`. A month the window cuts is summed from the daily
     *     statistics, which are kept for 25 months, so in a month older than that it is also no earlier than the
     *     oldest day still kept. Null when the bucket is not covered: none of its days lies within both the window
     *     and the stored data
     * @param \DateTimeImmutable|null $coveredTo Last day the bucket's counts include: the earliest of `period_end`,
     *     `end_date` and `data_available_to`. Null when the bucket is not covered
     * @param int|null $nxdomainCount Of those, queries answered with NXDOMAIN. Null when the bucket is not covered
     * @param int|null $queryCount Queries answered for the zone from `covered_from` to `covered_to`; 0 when none
     *     were recorded. Null when the bucket is not covered: no data, rather than no queries
     */
    public function __construct(
        public bool $partial,
        public \DateTimeImmutable $periodEnd,
        public \DateTimeImmutable $periodStart,
        public ?\DateTimeImmutable $coveredFrom = null,
        public ?\DateTimeImmutable $coveredTo = null,
        public ?int $nxdomainCount = null,
        public ?int $queryCount = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            partial: $data['partial'],
            periodEnd: Serializer::parseDate($data['period_end']),
            periodStart: Serializer::parseDate($data['period_start']),
            coveredFrom: isset($data['covered_from']) ? Serializer::parseDate($data['covered_from']) : null,
            coveredTo: isset($data['covered_to']) ? Serializer::parseDate($data['covered_to']) : null,
            nxdomainCount: $data['nxdomain_count'] ?? null,
            queryCount: $data['query_count'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'partial' => $this->partial,
            'period_end' => $this->periodEnd->format('Y-m-d'),
            'period_start' => $this->periodStart->format('Y-m-d'),
            'covered_from' => $this->coveredFrom === null ? null : $this->coveredFrom->format('Y-m-d'),
            'covered_to' => $this->coveredTo === null ? null : $this->coveredTo->format('Y-m-d'),
            'nxdomain_count' => $this->nxdomainCount,
            'query_count' => $this->queryCount,
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
