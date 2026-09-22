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

final readonly class MemoryFact implements ApiModel
{
    /**
     * @param string $factId TypeID prefix: fact.
     * @param string $organizationId TypeID prefix: organization.
     * @param array<string, mixed>|null $value
     */
    public function __construct(
        public \DateTimeImmutable $createdAt,
        public string $factId,
        public string $key,
        public MemoryFactKind|string $kind,
        public string $organizationId,
        public \DateTimeImmutable $updatedAt,
        public ?\DateTimeImmutable $expiresAt = null,
        public ?array $value = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdAt: new \DateTimeImmutable($data['created_at']),
            factId: $data['fact_id'],
            key: $data['key'],
            kind: MemoryFactKind::tryFrom($data['kind']) ?? $data['kind'],
            organizationId: $data['organization_id'],
            updatedAt: new \DateTimeImmutable($data['updated_at']),
            expiresAt: isset($data['expires_at']) ? new \DateTimeImmutable($data['expires_at']) : null,
            value: isset($data['value']) ? (array) $data['value'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_at' => $this->createdAt,
            'fact_id' => $this->factId,
            'key' => $this->key,
            'kind' => $this->kind,
            'organization_id' => $this->organizationId,
            'updated_at' => $this->updatedAt,
            'expires_at' => $this->expiresAt,
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
