<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class MemoryFactPatchRequest implements ApiModel
{
    /**
     * @param array<string, mixed>|null $value
     */
    public function __construct(
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
