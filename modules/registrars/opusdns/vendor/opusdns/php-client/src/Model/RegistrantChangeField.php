<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\AttributeType;
use OpusDNS\Client\Enum\RegistrantChangeFieldKey;
use OpusDNS\Client\Serializer;

final readonly class RegistrantChangeField implements ApiModel
{
    /**
     * @param RegistrantChangeFieldKey|string $key The key the field is sent under in `fields`
     * @param AttributeType|string $type Type of the field (e.g., 'enum', 'string', 'boolean')
     * @param bool $required Whether the field must be sent
     * @param list<string>|null $values Allowed values for enum types
     */
    public function __construct(
        public RegistrantChangeFieldKey|string $key,
        public AttributeType|string $type,
        public bool $required = false,
        public ?array $values = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            key: RegistrantChangeFieldKey::tryFrom($data['key']) ?? $data['key'],
            type: AttributeType::tryFrom($data['type']) ?? $data['type'],
            required: $data['required'] ?? false,
            values: $data['values'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'key' => $this->key,
            'type' => $this->type,
            'required' => $this->required,
            'values' => $this->values,
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
