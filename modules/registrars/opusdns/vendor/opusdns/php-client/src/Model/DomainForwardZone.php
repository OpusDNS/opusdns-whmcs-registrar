<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainForwardZone implements ApiModel
{
    /**
     * @param list<DomainForward> $domainForwards
     * @param string $zoneId TypeID prefix: zone.
     */
    public function __construct(
        public array $domainForwards,
        public string $zoneId,
        public string $zoneName,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            domainForwards: array_map(static fn (array $item): DomainForward => DomainForward::fromArray($item), $data['domain_forwards']),
            zoneId: $data['zone_id'],
            zoneName: $data['zone_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'domain_forwards' => $this->domainForwards,
            'zone_id' => $this->zoneId,
            'zone_name' => $this->zoneName,
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
