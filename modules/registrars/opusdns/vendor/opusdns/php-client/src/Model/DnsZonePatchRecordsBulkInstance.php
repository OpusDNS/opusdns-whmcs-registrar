<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZonePatchRecordsBulkInstance implements ApiModel
{
    /**
     * @param list<DnsRecordPatchOp> $ops
     * @param string $zoneName DNS zone name to patch
     */
    public function __construct(
        public array $ops,
        public string $zoneName,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            ops: array_map(static fn (array $item): DnsRecordPatchOp => DnsRecordPatchOp::fromArray($item), $data['ops']),
            zoneName: $data['zone_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'ops' => $this->ops,
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
