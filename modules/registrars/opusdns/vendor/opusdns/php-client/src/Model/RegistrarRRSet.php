<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class RegistrarRRSet implements ApiModel
{
    /**
     * @param list<RegistrarRecord> $record
     */
    public function __construct(
        public string $name,
        public int $ttl,
        public string $type,
        public ?int $priority = null,
        public array $record = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            ttl: $data['ttl'],
            type: $data['type'],
            priority: $data['priority'] ?? null,
            record: isset($data['record']) ? array_map(static fn (array $item): RegistrarRecord => RegistrarRecord::fromArray($item), $data['record']) : [],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'ttl' => $this->ttl,
            'type' => $this->type,
            'priority' => $this->priority,
            'record' => $this->record,
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
