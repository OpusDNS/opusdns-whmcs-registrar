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
 * Request body for updating a custom role. Omitted fields are left unchanged; `permissions` is a full
 * replacement set when provided.
 */
final readonly class CustomRoleUpdate implements ApiModel
{
    /**
     * @param string|null $description New description.
     * @param string|null $name New display name.
     * @param list<string>|null $permissions Full replacement set of `resource:scope` permissions the role grants.
     */
    public function __construct(
        public ?string $description = null,
        public ?string $name = null,
        public ?array $permissions = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            description: $data['description'] ?? null,
            name: $data['name'] ?? null,
            permissions: $data['permissions'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'description' => $this->description,
            'name' => $this->name,
            'permissions' => $this->permissions,
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
