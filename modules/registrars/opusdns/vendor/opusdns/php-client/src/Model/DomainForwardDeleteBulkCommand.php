<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class DomainForwardDeleteBulkCommand implements ApiModel
{
    /**
     * @param DomainForwardDeleteBulkPayload $payload Bulk domain forward delete payload
     * @param string|null $idempotencyKey Idempotency key for this bulk command
     * @param string $version Command version
     */
    public function __construct(
        public readonly DomainForwardDeleteBulkPayload $payload,
        public readonly string $command = 'domain_forward_delete_bulk',
        public readonly ?string $idempotencyKey = null,
        public readonly string $version = 'v1',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            payload: DomainForwardDeleteBulkPayload::fromArray($data['payload']),
            command: $data['command'] ?? 'domain_forward_delete_bulk',
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
