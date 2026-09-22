<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class OrganizationAttributeResponse implements ApiModel
{
    /**
     * @param string $key Key of the attribute.
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param bool $protected When true, the attribute is protected and cannot be modified by users.
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     * @param mixed $value Value of the attribute.
     */
    public function __construct(
        public string $key,
        public int $organizationAttributeId,
        public ?\DateTimeImmutable $createdOn = null,
        public bool $protected = false,
        public ?\DateTimeImmutable $updatedOn = null,
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
            organizationAttributeId: $data['organization_attribute_id'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            protected: $data['protected'] ?? false,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
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
            'organization_attribute_id' => $this->organizationAttributeId,
            'created_on' => $this->createdOn,
            'protected' => $this->protected,
            'updated_on' => $this->updatedOn,
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
