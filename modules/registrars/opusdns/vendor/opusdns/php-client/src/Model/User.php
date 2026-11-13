<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\UserProvisionedBy;
use OpusDNS\Client\Serializer;

final class User implements ApiModel
{
    /**
     * @param string $email The user's email address
     * @param string $firstName The user's first name
     * @param string $lastName The user's last name
     * @param string $username The user's unique username
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param \DateTimeImmutable|null $deactivatedOn When the user was deactivated
     * @param string|null $identityProviderId The identity provider the user last signed in through, null if none
     * @param string|null $keycloakUserId Keycloak user id
     * @param string|null $organizationId The user's organization id TypeID prefix: organization.
     * @param string|null $phone The user's phone number
     * @param UserProvisionedBy|string $provisionedBy How the user was created
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     * @param string|null $userId TypeID prefix: user.
     */
    public function __construct(
        public readonly string $email,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $locale,
        public readonly string $username,
        public readonly ?\DateTimeImmutable $createdOn = null,
        public readonly ?\DateTimeImmutable $deactivatedOn = null,
        public readonly ?string $identityProviderId = null,
        public readonly ?string $keycloakUserId = null,
        public readonly ?string $organizationId = null,
        public readonly ?string $phone = null,
        public readonly UserProvisionedBy|string $provisionedBy = UserProvisionedBy::LOCAL,
        public readonly ?\DateTimeImmutable $updatedOn = null,
        public readonly ?string $userId = null,
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
            deactivatedOn: isset($data['deactivated_on']) ? new \DateTimeImmutable($data['deactivated_on']) : null,
            identityProviderId: $data['identity_provider_id'] ?? null,
            keycloakUserId: $data['keycloak_user_id'] ?? null,
            organizationId: $data['organization_id'] ?? null,
            phone: $data['phone'] ?? null,
            provisionedBy: isset($data['provisioned_by']) ? UserProvisionedBy::tryFrom($data['provisioned_by']) ?? $data['provisioned_by'] : UserProvisionedBy::LOCAL,
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
            'deactivated_on' => $this->deactivatedOn,
            'identity_provider_id' => $this->identityProviderId,
            'keycloak_user_id' => $this->keycloakUserId,
            'organization_id' => $this->organizationId,
            'phone' => $this->phone,
            'provisioned_by' => $this->provisionedBy,
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
