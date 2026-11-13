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

final class UserPublic implements ApiModel
{
    /**
     * @param string $email The user's email address
     * @param string $firstName The user's first name
     * @param string $lastName The user's last name
     * @param UserProvisionedBy|string $provisionedBy How the user was created: `local` by sign-up or an admin, `jit`
     *     at their first sign-in through the organization's identity provider, `scim` by the identity provider's
     *     SCIM client
     * @param list<string> $ssoManagedFields The fields that come from the user's identity provider and cannot be
     *     changed here: username, email, first_name, last_name. Clients must treat unknown names as read-only too
     * @param string $username The user's unique username
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param UserIdentityProvider|null $identityProvider The identity provider that manages the user or that the
     *     user signs in through
     * @param string|null $organizationId The user's organization id TypeID prefix: organization.
     * @param string|null $phone The user's phone number
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     * @param string|null $userId TypeID prefix: user.
     */
    public function __construct(
        public readonly string $email,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $locale,
        public readonly UserProvisionedBy|string $provisionedBy,
        public readonly array $ssoManagedFields,
        public readonly string $username,
        public readonly ?\DateTimeImmutable $createdOn = null,
        public readonly ?UserIdentityProvider $identityProvider = null,
        public readonly ?string $organizationId = null,
        public readonly ?string $phone = null,
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
            provisionedBy: UserProvisionedBy::tryFrom($data['provisioned_by']) ?? $data['provisioned_by'],
            ssoManagedFields: $data['sso_managed_fields'],
            username: $data['username'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            identityProvider: isset($data['identity_provider']) ? UserIdentityProvider::fromArray($data['identity_provider']) : null,
            organizationId: $data['organization_id'] ?? null,
            phone: $data['phone'] ?? null,
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
            'provisioned_by' => $this->provisionedBy,
            'sso_managed_fields' => $this->ssoManagedFields,
            'username' => $this->username,
            'created_on' => $this->createdOn,
            'identity_provider' => $this->identityProvider,
            'organization_id' => $this->organizationId,
            'phone' => $this->phone,
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
