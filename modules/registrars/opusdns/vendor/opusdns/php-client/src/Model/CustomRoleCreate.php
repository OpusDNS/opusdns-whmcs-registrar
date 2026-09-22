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
 * Request body for creating a custom role.
 */
final readonly class CustomRoleCreate implements ApiModel
{
    /**
     * @param string $name Display name of the custom role as provided by the user (e.g. 'Support Staff').
     * @param list<string> $permissions Permissions the role grants, as `resource:scope` (e.g. `domains:read`). The
     *     escalation-bearing admin/owner permissions cannot be granted.
     * @param string|null $description Description of the custom role.
     */
    public function __construct(
        public string $name,
        public array $permissions,
        public ?string $description = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            permissions: $data['permissions'],
            description: $data['description'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'permissions' => $this->permissions,
            'description' => $this->description,
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
