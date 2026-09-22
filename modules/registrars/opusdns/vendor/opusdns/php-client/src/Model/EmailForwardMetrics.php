<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardMetrics implements ApiModel
{
    /**
     * @param array<string, int> $byStatus Log counts grouped by status (QUEUED, DELIVERED, REFUSED, SOFT-BOUNCE,
     *     HARD-BOUNCE)
     * @param EmailForwardMetricsFilters $filters Applied filters
     * @param EmailForwardMetricsRates $rates Rate percentages for each status
     * @param int $totalLogs Total number of email forward logs
     * @param int|null $aliasCount Number of aliases
     * @param list<EmailForwardAliasMetrics>|null $byAlias Metrics breakdown per alias
     */
    public function __construct(
        public array $byStatus,
        public EmailForwardMetricsFilters $filters,
        public EmailForwardMetricsRates $rates,
        public int $totalLogs,
        public ?int $aliasCount = null,
        public ?array $byAlias = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            byStatus: (array) $data['by_status'],
            filters: EmailForwardMetricsFilters::fromArray($data['filters']),
            rates: EmailForwardMetricsRates::fromArray($data['rates']),
            totalLogs: $data['total_logs'],
            aliasCount: $data['alias_count'] ?? null,
            byAlias: isset($data['by_alias']) ? array_map(static fn (array $item): EmailForwardAliasMetrics => EmailForwardAliasMetrics::fromArray($item), $data['by_alias']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'by_status' => ($this->byStatus === [] ? new \stdClass() : $this->byStatus),
            'filters' => $this->filters,
            'rates' => $this->rates,
            'total_logs' => $this->totalLogs,
            'alias_count' => $this->aliasCount,
            'by_alias' => $this->byAlias,
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
