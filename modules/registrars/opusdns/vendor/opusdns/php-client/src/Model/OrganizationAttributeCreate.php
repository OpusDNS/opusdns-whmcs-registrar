<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class OrganizationAttributeCreate implements ApiModel
{
    /**
     * @param string $key Key of the attribute.
     * @param bool $private When true, the attribute is private and not visible to users.
     * @param bool $protected When true, the attribute is protected and cannot be modified by users.
     * @param mixed $value Value of the attribute.
     */
    public function __construct(
        public string $key,
        public bool $private = false,
        public bool $protected = false,
        public mixed $value = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            key: $data['key'],
            private: $data['private'] ?? false,
            protected: $data['protected'] ?? false,
            value: $data['value'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'key' => $this->key,
            'private' => $this->private,
            'protected' => $this->protected,
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
