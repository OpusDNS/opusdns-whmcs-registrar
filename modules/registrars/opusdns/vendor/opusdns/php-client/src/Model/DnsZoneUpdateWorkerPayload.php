<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZoneUpdateWorkerPayload implements ApiModel
{
    public function __construct(
        public string $operation,
        public string $type,
        public DnsZoneUpdatePayloadData $zone,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            operation: $data['operation'],
            type: $data['type'],
            zone: DnsZoneUpdatePayloadData::fromArray($data['zone']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'operation' => $this->operation,
            'type' => $this->type,
            'zone' => $this->zone,
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
