<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZoneSummary implements ApiModel
{
    /**
     * @param int $totalZones Total number of DNS zones
     * @param array<string, int>|null $zonesByDnssec Count of zones by DNSSEC status
     */
    public function __construct(
        public int $totalZones,
        public ?array $zonesByDnssec = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            totalZones: $data['total_zones'],
            zonesByDnssec: isset($data['zones_by_dnssec']) ? (array) $data['zones_by_dnssec'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'total_zones' => $this->totalZones,
            'zones_by_dnssec' => $this->zonesByDnssec === null ? null : ($this->zonesByDnssec === [] ? new \stdClass() : $this->zonesByDnssec),
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
