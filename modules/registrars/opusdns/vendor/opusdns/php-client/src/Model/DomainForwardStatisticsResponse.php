<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainForwardStatisticsGranularity;
use OpusDNS\Client\Serializer;

final class DomainForwardStatisticsResponse implements ApiModel
{
    /**
     * @param list<DomainForwardStatisticsBreakdownRow> $breakdown The groups with the most redirects by the
     *     dimension requested with `breakdown`, most first, at most `breakdown_limit`; empty unless requested, and
     *     empty when the totals are null. For `url` at most 5 values per day went into the list, each with at least
     *     3 hits that day. Country data is derived from IP addresses with GeoLite2 data created by MaxMind
     *     (https://www.maxmind.com)
     * @param bool $breakdownApproximate True when the `breakdown` list may miss values or count them too low. For
     *     `user_agent`, `referrer`, `fqdn`, `domain`, `forward` and `rule`, days that are over are usually read from
     *     daily top lists, in which a value that did not make a day's list is missing for that day; the current day,
     *     and queries with a `hostname`, `domain` or `protocol` filter, are counted from all requests. `url` is
     *     built from the daily top 5 lists of the domain and is approximate as soon as the window includes a day
     *     that is over. `browser`, `platform`, `country` and `status_code` are counted exactly. Also true when a
     *     query has more distinct values than can be ranked at once and the rest is left out. Always false without a
     *     breakdown
     * @param list<DomainForwardStatisticsBucket> $buckets One entry per bucket the window touches, oldest first,
     *     including buckets without redirects (0) and buckets without data (null)
     * @param \DateTimeImmutable $end End of the window as an instant (UTC), exclusive: the day after `end_date` at
     *     00:00, or `end` as requested
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive (UTC); for a window given as `start` and
     *     `end`, the day of its last instant
     * @param DomainForwardStatisticsGranularity|string $granularity Time-bucket size of the series
     * @param \DateTimeImmutable $start Start of the window as an instant (UTC), inclusive: `start_date` at 00:00, or
     *     `start` as requested
     * @param \DateTimeImmutable $startDate First day of the window, inclusive (UTC); for a window given as `start`
     *     and `end`, the day `start` falls in
     * @param \DateTimeImmutable|null $dataAvailableFrom Earliest instant the data behind the answer holds: the later
     *     of the retention limit and the first ingested redirect. A window reaching further back is empty before it,
     *     which is not the same as zero redirects. Null when there is no data
     * @param \DateTimeImmutable|null $dataAvailableTo Time of the latest ingested redirect, no earlier than the
     *     start of the newest bucket with redirects; a bucket reaching it is partial. Null when there is no data
     */
    public function __construct(
        public readonly array $breakdown,
        public readonly bool $breakdownApproximate,
        public readonly array $buckets,
        public readonly \DateTimeImmutable $end,
        public readonly \DateTimeImmutable $endDate,
        public readonly DomainForwardStatisticsGranularity|string $granularity,
        public readonly \DateTimeImmutable $start,
        public readonly \DateTimeImmutable $startDate,
        public readonly DomainForwardStatisticsTotals $totals,
        public readonly ?\DateTimeImmutable $dataAvailableFrom = null,
        public readonly ?\DateTimeImmutable $dataAvailableTo = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            breakdown: array_map(static fn (array $item): DomainForwardStatisticsBreakdownRow => DomainForwardStatisticsBreakdownRow::fromArray($item), $data['breakdown']),
            breakdownApproximate: $data['breakdown_approximate'],
            buckets: array_map(static fn (array $item): DomainForwardStatisticsBucket => DomainForwardStatisticsBucket::fromArray($item), $data['buckets']),
            end: new \DateTimeImmutable($data['end']),
            endDate: Serializer::parseDate($data['end_date']),
            granularity: DomainForwardStatisticsGranularity::tryFrom($data['granularity']) ?? $data['granularity'],
            start: new \DateTimeImmutable($data['start']),
            startDate: Serializer::parseDate($data['start_date']),
            totals: DomainForwardStatisticsTotals::fromArray($data['totals']),
            dataAvailableFrom: isset($data['data_available_from']) ? new \DateTimeImmutable($data['data_available_from']) : null,
            dataAvailableTo: isset($data['data_available_to']) ? new \DateTimeImmutable($data['data_available_to']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'breakdown' => $this->breakdown,
            'breakdown_approximate' => $this->breakdownApproximate,
            'buckets' => $this->buckets,
            'end' => $this->end,
            'end_date' => $this->endDate->format('Y-m-d'),
            'granularity' => $this->granularity,
            'start' => $this->start,
            'start_date' => $this->startDate->format('Y-m-d'),
            'totals' => $this->totals,
            'data_available_from' => $this->dataAvailableFrom,
            'data_available_to' => $this->dataAvailableTo,
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
