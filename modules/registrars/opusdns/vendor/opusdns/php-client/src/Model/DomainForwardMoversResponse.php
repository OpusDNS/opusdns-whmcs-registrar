<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainForwardMoverDirection;
use OpusDNS\Client\Enum\DomainForwardMoversPeriod;
use OpusDNS\Client\Serializer;

final class DomainForwardMoversResponse implements ApiModel
{
    /**
     * @param bool $complete False while the previous period begins before `data_available_from`: its count is then
     *     too low, and a rise may only be the data catching up. True when both periods are covered by data
     * @param DomainForwardMoverDirection|string $direction Whether the list shows drops or rises
     * @param DomainForwardMoversPeriod|string $period The period compared with the one before it
     * @param \DateTimeImmutable $periodEnd Last day of the period (UTC): the newest complete day with data, at most
     *     yesterday
     * @param \DateTimeImmutable $periodStart First day of the period (UTC)
     * @param \DateTimeImmutable $previousPeriodEnd Last day of the period compared with (UTC)
     * @param \DateTimeImmutable $previousPeriodStart First day of the period compared with (UTC)
     * @param list<DomainForwardMoverResponse> $results The domains with the largest drop or rise, the largest first,
     *     at most `limit`
     * @param \DateTimeImmutable|null $dataAvailableFrom Earliest instant the data behind the answer holds: the later
     *     of the retention limit and the first ingested redirect. Null when there is no data
     * @param \DateTimeImmutable|null $dataAvailableTo Time of the latest ingested redirect. Null when there is no
     *     data
     */
    public function __construct(
        public readonly bool $complete,
        public readonly DomainForwardMoverDirection|string $direction,
        public readonly DomainForwardMoversPeriod|string $period,
        public readonly \DateTimeImmutable $periodEnd,
        public readonly \DateTimeImmutable $periodStart,
        public readonly \DateTimeImmutable $previousPeriodEnd,
        public readonly \DateTimeImmutable $previousPeriodStart,
        public readonly array $results,
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
            complete: $data['complete'],
            direction: DomainForwardMoverDirection::tryFrom($data['direction']) ?? $data['direction'],
            period: DomainForwardMoversPeriod::tryFrom($data['period']) ?? $data['period'],
            periodEnd: Serializer::parseDate($data['period_end']),
            periodStart: Serializer::parseDate($data['period_start']),
            previousPeriodEnd: Serializer::parseDate($data['previous_period_end']),
            previousPeriodStart: Serializer::parseDate($data['previous_period_start']),
            results: array_map(static fn (array $item): DomainForwardMoverResponse => DomainForwardMoverResponse::fromArray($item), $data['results']),
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
            'complete' => $this->complete,
            'direction' => $this->direction,
            'period' => $this->period,
            'period_end' => $this->periodEnd->format('Y-m-d'),
            'period_start' => $this->periodStart->format('Y-m-d'),
            'previous_period_end' => $this->previousPeriodEnd->format('Y-m-d'),
            'previous_period_start' => $this->previousPeriodStart->format('Y-m-d'),
            'results' => $this->results,
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
