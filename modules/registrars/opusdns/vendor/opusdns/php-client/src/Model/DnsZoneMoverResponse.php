<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZoneMoverResponse implements ApiModel
{
    /**
     * @param int $change `query_count` minus `previous_query_count`
     * @param string $organizationId The organization the zone belongs to TypeID prefix: organization.
     * @param int $previousQueryCount Queries in the period of the same length before it
     * @param int $queryCount Queries in the period
     * @param string $zoneName The zone, with a trailing dot
     * @param float|null $changeRatio `change` relative to `previous_query_count`; null when the previous period had
     *     no queries
     * @param \DateTimeImmutable|null $zoneCreatedOn Day the zone was created (UTC); null when unknown
     */
    public function __construct(
        public int $change,
        public string $organizationId,
        public int $previousQueryCount,
        public int $queryCount,
        public string $zoneName,
        public ?float $changeRatio = null,
        public ?\DateTimeImmutable $zoneCreatedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            change: $data['change'],
            organizationId: $data['organization_id'],
            previousQueryCount: $data['previous_query_count'],
            queryCount: $data['query_count'],
            zoneName: $data['zone_name'],
            changeRatio: $data['change_ratio'] ?? null,
            zoneCreatedOn: isset($data['zone_created_on']) ? Serializer::parseDate($data['zone_created_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'change' => $this->change,
            'organization_id' => $this->organizationId,
            'previous_query_count' => $this->previousQueryCount,
            'query_count' => $this->queryCount,
            'zone_name' => $this->zoneName,
            'change_ratio' => $this->changeRatio,
            'zone_created_on' => $this->zoneCreatedOn === null ? null : $this->zoneCreatedOn->format('Y-m-d'),
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
