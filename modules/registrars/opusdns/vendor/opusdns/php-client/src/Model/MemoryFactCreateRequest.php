<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\MemoryFactKind;
use OpusDNS\Client\Serializer;

final readonly class MemoryFactCreateRequest implements ApiModel
{
    /**
     * @param int|null $ttlSeconds Optional TTL; if set, the fact expires after this many seconds.
     * @param array<string, mixed>|null $value
     */
    public function __construct(
        public string $key,
        public MemoryFactKind|string $kind,
        public ?int $ttlSeconds = null,
        public ?array $value = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            key: $data['key'],
            kind: MemoryFactKind::tryFrom($data['kind']) ?? $data['kind'],
            ttlSeconds: $data['ttl_seconds'] ?? null,
            value: isset($data['value']) ? (array) $data['value'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'key' => $this->key,
            'kind' => $this->kind,
            'ttl_seconds' => $this->ttlSeconds,
            'value' => $this->value === null ? null : ($this->value === [] ? new \stdClass() : $this->value),
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
