<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class DomainForwardStatisticsBucket implements ApiModel
{
    /**
     * @param \DateTimeImmutable $end First instant after the bucket (UTC), exclusive: the start of the next bucket
     * @param bool $partial True when the counts are not those of the whole bucket: the window cuts the bucket, it
     *     begins before `data_available_from`, or it reaches `data_available_to`, which is still running. Also true
     *     for a bucket that is not covered, which has no counts. A partial bucket must not be read as a rise or fall
     *     against its neighbours
     * @param \DateTimeImmutable $periodEnd Last day of the bucket (UTC), inclusive: the day itself (for an hour, the
     *     day it falls in), the Sunday of its week, or the last day of its month
     * @param \DateTimeImmutable $periodStart First day of the bucket (UTC); for an hour, the day it falls in
     * @param \DateTimeImmutable $start First instant of the bucket (UTC), inclusive
     * @param \DateTimeImmutable|null $coveredFrom First day the bucket's counts include: the latest of
     *     `period_start`, `start_date` and the day of `data_available_from`. Null when the bucket is not covered:
     *     none of its instants lies within both the window and `data_available_from`..`data_available_to`
     * @param \DateTimeImmutable|null $coveredTo Last day the bucket's counts include: the earliest of `period_end`,
     *     `end_date` and the day of `data_available_to`. Null when the bucket is not covered
     * @param int|null $totalVisits Number of redirects served in the bucket; 0 when none were. Null when the bucket
     *     is not covered: no data, rather than no redirects
     * @param int|null $uniqueVisits Estimated number of distinct visitors (distinct client IP addresses, stored only
     *     as a keyed hash), counted with a HyperLogLog sketch and merged over the whole window rather than summed
     *     over buckets, so the figures of buckets do not add up to the total. Counted per bucket; 0 when none were.
     *     Null when the bucket is not covered: no data, rather than no redirects
     */
    public function __construct(
        public readonly \DateTimeImmutable $end,
        public readonly bool $partial,
        public readonly \DateTimeImmutable $periodEnd,
        public readonly \DateTimeImmutable $periodStart,
        public readonly \DateTimeImmutable $start,
        public readonly ?\DateTimeImmutable $coveredFrom = null,
        public readonly ?\DateTimeImmutable $coveredTo = null,
        public readonly ?int $totalVisits = null,
        public readonly ?int $uniqueVisits = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            end: new \DateTimeImmutable($data['end']),
            partial: $data['partial'],
            periodEnd: Serializer::parseDate($data['period_end']),
            periodStart: Serializer::parseDate($data['period_start']),
            start: new \DateTimeImmutable($data['start']),
            coveredFrom: isset($data['covered_from']) ? Serializer::parseDate($data['covered_from']) : null,
            coveredTo: isset($data['covered_to']) ? Serializer::parseDate($data['covered_to']) : null,
            totalVisits: $data['total_visits'] ?? null,
            uniqueVisits: $data['unique_visits'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'end' => $this->end,
            'partial' => $this->partial,
            'period_end' => $this->periodEnd->format('Y-m-d'),
            'period_start' => $this->periodStart->format('Y-m-d'),
            'start' => $this->start,
            'covered_from' => $this->coveredFrom === null ? null : $this->coveredFrom->format('Y-m-d'),
            'covered_to' => $this->coveredTo === null ? null : $this->coveredTo->format('Y-m-d'),
            'total_visits' => $this->totalVisits,
            'unique_visits' => $this->uniqueVisits,
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
