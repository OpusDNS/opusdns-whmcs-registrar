<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class AggregationResult implements ApiModel
{
    /**
     * @param list<AggregationRow>|null $rows
     * @param array<string, float>|null $values
     */
    public function __construct(
        public string $name,
        public string $type,
        public ?string $field = null,
        public ?int $otherCount = null,
        public ?array $rows = null,
        public ?float $value = null,
        public ?array $values = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            type: $data['type'],
            field: $data['field'] ?? null,
            otherCount: $data['other_count'] ?? null,
            rows: isset($data['rows']) ? array_map(static fn (array $item): AggregationRow => AggregationRow::fromArray($item), $data['rows']) : null,
            value: $data['value'] ?? null,
            values: isset($data['values']) ? (array) $data['values'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'type' => $this->type,
            'field' => $this->field,
            'other_count' => $this->otherCount,
            'rows' => $this->rows,
            'value' => $this->value,
            'values' => $this->values === null ? null : ($this->values === [] ? new \stdClass() : $this->values),
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
