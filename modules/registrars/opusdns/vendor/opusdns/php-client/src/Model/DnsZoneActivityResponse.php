<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZoneActivityResponse implements ApiModel
{
    /**
     * @param int $nxdomainCount Of those, queries answered with NXDOMAIN
     * @param float $nxdomainRatio `nxdomain_count` / `query_count`; 0 without queries
     * @param string $organizationId The organization the zone belongs to TypeID prefix: organization.
     * @param int $queryCount Queries answered for the zone in the period
     * @param string $zoneName The zone, with a trailing dot
     * @param \DateTimeImmutable|null $lastQueryDate Last day with queries within the last 90 days; null when there
     *     was none
     * @param \DateTimeImmutable|null $zoneCreatedOn Day the zone was created (UTC); null when unknown
     */
    public function __construct(
        public int $nxdomainCount,
        public float $nxdomainRatio,
        public string $organizationId,
        public int $queryCount,
        public string $zoneName,
        public ?\DateTimeImmutable $lastQueryDate = null,
        public ?\DateTimeImmutable $zoneCreatedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            nxdomainCount: $data['nxdomain_count'],
            nxdomainRatio: $data['nxdomain_ratio'],
            organizationId: $data['organization_id'],
            queryCount: $data['query_count'],
            zoneName: $data['zone_name'],
            lastQueryDate: isset($data['last_query_date']) ? Serializer::parseDate($data['last_query_date']) : null,
            zoneCreatedOn: isset($data['zone_created_on']) ? Serializer::parseDate($data['zone_created_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'nxdomain_count' => $this->nxdomainCount,
            'nxdomain_ratio' => $this->nxdomainRatio,
            'organization_id' => $this->organizationId,
            'query_count' => $this->queryCount,
            'zone_name' => $this->zoneName,
            'last_query_date' => $this->lastQueryDate === null ? null : $this->lastQueryDate->format('Y-m-d'),
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
