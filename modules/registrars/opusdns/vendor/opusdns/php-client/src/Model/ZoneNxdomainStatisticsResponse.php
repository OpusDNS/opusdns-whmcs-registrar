<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ZoneNxdomainStatisticsResponse implements ApiModel
{
    /**
     * @param \DateTimeImmutable $endDate Last day of the window, inclusive
     * @param list<ZoneNxdomainNameResponse> $results
     * @param \DateTimeImmutable $startDate First day of the window, inclusive. Counts start no earlier than the day
     *     the zone was created, which is counted whole, with answers from before the zone existed
     * @param string $zoneName The zone the names belong to, with a trailing dot
     * @param \DateTimeImmutable|null $dataAvailableFrom First day names are kept for: 30 days before today, or the
     *     day the zone was created if that is later. Null while none are kept
     * @param \DateTimeImmutable|null $dataAvailableTo Last day names are kept for, usually today. Null while none
     *     are
     * @param \DateTimeImmutable|null $dataCompleteTo Newest day whose list is final, usually yesterday from 02:00
     *     UTC on. The days after it are still counting. Null while there is none. A day collection missed is not
     *     listed, and cannot be later
     * @param string|null $qtype The query type the names are filtered by; null for all types
     */
    public function __construct(
        public \DateTimeImmutable $endDate,
        public PaginationMetadata $pagination,
        public array $results,
        public \DateTimeImmutable $startDate,
        public ZoneNxdomainTotalsResponse $totals,
        public string $zoneName,
        public ?\DateTimeImmutable $dataAvailableFrom = null,
        public ?\DateTimeImmutable $dataAvailableTo = null,
        public ?\DateTimeImmutable $dataCompleteTo = null,
        public ?string $qtype = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            endDate: Serializer::parseDate($data['end_date']),
            pagination: PaginationMetadata::fromArray($data['pagination']),
            results: array_map(static fn (array $item): ZoneNxdomainNameResponse => ZoneNxdomainNameResponse::fromArray($item), $data['results']),
            startDate: Serializer::parseDate($data['start_date']),
            totals: ZoneNxdomainTotalsResponse::fromArray($data['totals']),
            zoneName: $data['zone_name'],
            dataAvailableFrom: isset($data['data_available_from']) ? Serializer::parseDate($data['data_available_from']) : null,
            dataAvailableTo: isset($data['data_available_to']) ? Serializer::parseDate($data['data_available_to']) : null,
            dataCompleteTo: isset($data['data_complete_to']) ? Serializer::parseDate($data['data_complete_to']) : null,
            qtype: $data['qtype'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'end_date' => $this->endDate->format('Y-m-d'),
            'pagination' => $this->pagination,
            'results' => $this->results,
            'start_date' => $this->startDate->format('Y-m-d'),
            'totals' => $this->totals,
            'zone_name' => $this->zoneName,
            'data_available_from' => $this->dataAvailableFrom === null ? null : $this->dataAvailableFrom->format('Y-m-d'),
            'data_available_to' => $this->dataAvailableTo === null ? null : $this->dataAvailableTo->format('Y-m-d'),
            'data_complete_to' => $this->dataCompleteTo === null ? null : $this->dataCompleteTo->format('Y-m-d'),
            'qtype' => $this->qtype,
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
