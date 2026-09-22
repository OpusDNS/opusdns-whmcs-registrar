<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * A role as listed/read through the public API — built-in or custom.
 */
final readonly class PublicRoleDefinition implements ApiModel
{
    /**
     * @param bool $builtIn Built-in roles are immutable; custom roles are organization-owned.
     * @param string $label Per-organization unique identifier (snake_case, e.g. 'support_staff'). Used as the URL
     *     path parameter.
     * @param string $name Display name of the role (e.g. 'Support Staff').
     * @param list<string> $permissions Permissions the role grants, as `resource:scope` strings.
     * @param \DateTimeImmutable|null $createdOn Creation time (custom roles only).
     * @param string|null $description Description of the role.
     * @param \DateTimeImmutable|null $updatedOn Last update time (custom roles only).
     */
    public function __construct(
        public bool $builtIn,
        public string $label,
        public string $name,
        public array $permissions,
        public ?\DateTimeImmutable $createdOn = null,
        public ?string $description = null,
        public ?\DateTimeImmutable $updatedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            builtIn: $data['built_in'],
            label: $data['label'],
            name: $data['name'],
            permissions: $data['permissions'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            description: $data['description'] ?? null,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'built_in' => $this->builtIn,
            'label' => $this->label,
            'name' => $this->name,
            'permissions' => $this->permissions,
            'created_on' => $this->createdOn,
            'description' => $this->description,
            'updated_on' => $this->updatedOn,
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
