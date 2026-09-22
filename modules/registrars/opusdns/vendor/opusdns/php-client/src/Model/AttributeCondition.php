<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ConditionOperator;
use OpusDNS\Client\Enum\RegistryHandleAttributeType;
use OpusDNS\Client\Serializer;

final readonly class AttributeCondition implements ApiModel
{
    /**
     * @param RegistryHandleAttributeType|string $field The attribute key to evaluate
     * @param ConditionOperator|string $operator The comparison operator
     * @param string|list<string> $value The value(s) to compare against
     */
    public function __construct(
        public RegistryHandleAttributeType|string $field,
        public ConditionOperator|string $operator,
        public string|array $value,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            field: RegistryHandleAttributeType::tryFrom($data['field']) ?? $data['field'],
            operator: ConditionOperator::tryFrom($data['operator']) ?? $data['operator'],
            value: $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'field' => $this->field,
            'operator' => $this->operator,
            'value' => $this->value,
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
