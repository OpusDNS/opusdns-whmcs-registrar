<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZonePatchRecordsWorkerPayload implements ApiModel
{
    public function __construct(
        public string $operation,
        public DnsZonePatchRecordsBulkInstance $zone,
        public string $type = 'dns_zone_patch_records_bulk',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            operation: $data['operation'],
            zone: DnsZonePatchRecordsBulkInstance::fromArray($data['zone']),
            type: $data['type'] ?? 'dns_zone_patch_records_bulk',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'operation' => $this->operation,
            'zone' => $this->zone,
            'type' => $this->type,
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
