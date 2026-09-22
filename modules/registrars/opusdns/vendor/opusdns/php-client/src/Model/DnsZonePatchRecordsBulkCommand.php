<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZonePatchRecordsBulkCommand implements ApiModel
{
    /**
     * @param DnsZonePatchRecordsBulkPayload $payload DNS zone patch records bulk payload
     * @param string|null $idempotencyKey Idempotency key for this command
     * @param string $version Command version
     */
    public function __construct(
        public DnsZonePatchRecordsBulkPayload $payload,
        public string $command = 'dns_zone_patch_records_bulk',
        public ?string $idempotencyKey = null,
        public string $version = 'v1',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            payload: DnsZonePatchRecordsBulkPayload::fromArray($data['payload']),
            command: $data['command'] ?? 'dns_zone_patch_records_bulk',
            idempotencyKey: $data['idempotency_key'] ?? null,
            version: $data['version'] ?? 'v1',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'payload' => $this->payload,
            'command' => $this->command,
            'idempotency_key' => $this->idempotencyKey,
            'version' => $this->version,
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
