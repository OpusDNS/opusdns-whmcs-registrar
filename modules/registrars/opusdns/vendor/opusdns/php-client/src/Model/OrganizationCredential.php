<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\OrganizationCredentialStatus;
use OpusDNS\Client\Enum\PublicRole;
use OpusDNS\Client\Serializer;

final readonly class OrganizationCredential implements ApiModel
{
    /**
     * @param string $apiKeyId Unique identifier of the organization credential. TypeID prefix: api_key.
     * @param OrganizationCredentialStatus|string $status The status of the organization credential.
     * @param string|null $apiKeyDescription Description of the organization credential.
     * @param string|null $apiKeyName Name of the organization credential. Only a-z, A-Z, 0-9, underscore, and hyphen
     *     are allowed.
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param \DateTimeImmutable|null $deletedOn The date/time the entry was deleted on
     * @param \DateTimeImmutable|null $expiresAt The date and time the credential expiration.
     * @param \DateTimeImmutable|null $lastUsedOn The date/time the entry was last used on
     * @param string|null $organizationId TypeID prefix: organization.
     * @param PublicRole|string|null $role
     */
    public function __construct(
        public string $apiKeyId,
        public OrganizationCredentialStatus|string $status,
        public ?string $apiKeyDescription = null,
        public ?string $apiKeyName = null,
        public ?\DateTimeImmutable $createdOn = null,
        public ?\DateTimeImmutable $deletedOn = null,
        public ?\DateTimeImmutable $expiresAt = null,
        public ?\DateTimeImmutable $lastUsedOn = null,
        public ?string $organizationId = null,
        public PublicRole|string|null $role = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            apiKeyId: $data['api_key_id'],
            status: OrganizationCredentialStatus::tryFrom($data['status']) ?? $data['status'],
            apiKeyDescription: $data['api_key_description'] ?? null,
            apiKeyName: $data['api_key_name'] ?? null,
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            deletedOn: isset($data['deleted_on']) ? new \DateTimeImmutable($data['deleted_on']) : null,
            expiresAt: isset($data['expires_at']) ? new \DateTimeImmutable($data['expires_at']) : null,
            lastUsedOn: isset($data['last_used_on']) ? new \DateTimeImmutable($data['last_used_on']) : null,
            organizationId: $data['organization_id'] ?? null,
            role: isset($data['role']) ? PublicRole::tryFrom($data['role']) ?? $data['role'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'api_key_id' => $this->apiKeyId,
            'status' => $this->status,
            'api_key_description' => $this->apiKeyDescription,
            'api_key_name' => $this->apiKeyName,
            'created_on' => $this->createdOn,
            'deleted_on' => $this->deletedOn,
            'expires_at' => $this->expiresAt,
            'last_used_on' => $this->lastUsedOn,
            'organization_id' => $this->organizationId,
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
