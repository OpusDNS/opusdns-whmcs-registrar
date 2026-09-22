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

final readonly class UserPublicWithRole implements ApiModel
{
    /**
     * @param string $email The user's email address
     * @param string $firstName The user's first name
     * @param string $lastName The user's last name
     * @param string $username The user's unique username
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param string|null $organizationId The user's organization id TypeID prefix: organization.
     * @param string|null $phone The user's phone number
     * @param PublicRole|string|null $role
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     * @param string|null $userId TypeID prefix: user.
     */
    public function __construct(
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $locale,
        public string $username,
        public ?\DateTimeImmutable $createdOn = null,
        public ?string $organizationId = null,
        public ?string $phone = null,
        public PublicRole|string|null $role = null,
        public ?\DateTimeImmutable $updatedOn = null,
        public ?string $userId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            email: $data['email'],
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            locale: $data['locale'],
            username: $data['username'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            organizationId: $data['organization_id'] ?? null,
            phone: $data['phone'] ?? null,
            role: isset($data['role']) ? PublicRole::tryFrom($data['role']) ?? $data['role'] : null,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
            userId: $data['user_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'email' => $this->email,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'locale' => $this->locale,
            'username' => $this->username,
            'created_on' => $this->createdOn,
            'organization_id' => $this->organizationId,
            'phone' => $this->phone,
            'role' => $this->role,
            'updated_on' => $this->updatedOn,
            'user_id' => $this->userId,
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
