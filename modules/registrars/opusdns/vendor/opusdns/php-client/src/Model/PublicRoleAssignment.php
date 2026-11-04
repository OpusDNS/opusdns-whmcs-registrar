<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\PublicRole;
use OpusDNS\Client\Serializer;

final readonly class PublicRoleAssignment implements ApiModel
{
    /**
     * @param bool $managedBySso The role comes from the organization's identity provider and cannot be changed here
     * @param PublicRole|string|null $role
     */
    public function __construct(
        public bool $managedBySso = false,
        public PublicRole|string|null $role = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            managedBySso: $data['managed_by_sso'] ?? false,
            role: isset($data['role']) ? PublicRole::tryFrom($data['role']) ?? $data['role'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'managed_by_sso' => $this->managedBySso,
            'role' => $this->role,
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
