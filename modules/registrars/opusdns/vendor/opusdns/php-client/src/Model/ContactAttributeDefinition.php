<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\AttributeType;
use OpusDNS\Client\Enum\DomainContactType;
use OpusDNS\Client\Enum\RegistryHandleAttributeType;
use OpusDNS\Client\Serializer;

/**
 * Definition of a possible attribute for a TLD.
 */
final readonly class ContactAttributeDefinition implements ApiModel
{
    /**
     * @param RegistryHandleAttributeType|string $key Unique identifier for the attribute
     * @param AttributeType|string $type Type of the attribute (e.g., 'enum', 'string', 'boolean')
     * @param list<AttributeCondition>|null $conditions Conditions that must ALL be true for this attribute to be
     *     active. None means always active.
     * @param list<DomainContactType|string>|null $contactRoles Contact roles this attribute applies to. None means
     *     all roles.
     * @param bool $required Whether this attribute is required when its conditions are met
     * @param list<string>|null $values Allowed values for enum types
     */
    public function __construct(
        public RegistryHandleAttributeType|string $key,
        public AttributeType|string $type,
        public ?array $conditions = null,
        public ?array $contactRoles = null,
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
            key: RegistryHandleAttributeType::tryFrom($data['key']) ?? $data['key'],
            type: AttributeType::tryFrom($data['type']) ?? $data['type'],
            conditions: isset($data['conditions']) ? array_map(static fn (array $item): AttributeCondition => AttributeCondition::fromArray($item), $data['conditions']) : null,
            contactRoles: isset($data['contact_roles']) ? array_map(static fn (string $item): DomainContactType|string => DomainContactType::tryFrom($item) ?? $item, $data['contact_roles']) : null,
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
            'conditions' => $this->conditions,
            'contact_roles' => $this->contactRoles,
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
