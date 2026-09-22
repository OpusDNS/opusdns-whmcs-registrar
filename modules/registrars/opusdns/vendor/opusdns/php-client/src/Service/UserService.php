<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Model\PublicPermissionSet;
use OpusDNS\Client\Model\PublicRoleAssignment;
use OpusDNS\Client\Model\PublicRoleAssignmentRequest;
use OpusDNS\Client\Model\UserCreate;
use OpusDNS\Client\Model\UserProfile;
use OpusDNS\Client\Model\UserPublic;
use OpusDNS\Client\Model\UserPublicWithAttributes;
use OpusDNS\Client\Model\UserUpdate;

/**
 * Operations tagged "user".
 */
final class UserService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Create a user
     *
     * Create a new user
     *
     * Required permissions: users:manage
     *
     * @param UserCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createUser(UserCreate|array $body, ?string $xDatetimeFormat = null): UserPublic
    {
        $response = $this->client->request(
            'POST',
            Endpoint::USERS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): UserPublic => UserPublic::fromArray($data));
    }

    /**
     * Get current user
     *
     * Get the current user
     *
     * Required permissions: users:read
     *
     * @param list<string>|null $attributes
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getCurrentUser(?array $attributes = null, ?string $xDatetimeFormat = null): UserProfile
    {
        $response = $this->client->request(
            'GET',
            Endpoint::USERS_ME,
            query: ['attributes' => $attributes],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): UserProfile => UserProfile::fromArray($data));
    }

    /**
     * Get a user
     *
     * Get a user by ID
     *
     * Required permissions: users:read
     *
     * @param list<string>|null $attributes
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getUser(
        string $userId,
        ?array $attributes = null,
        ?string $xDatetimeFormat = null,
    ): UserPublicWithAttributes {
        $response = $this->client->request(
            'GET',
            Endpoint::USERS_BY_USER_ID,
            path: ['user_id' => $userId],
            query: ['attributes' => $attributes],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): UserPublicWithAttributes => UserPublicWithAttributes::fromArray($data));
    }

    /**
     * Update a user
     *
     * Update a user by ID
     *
     * Required permissions: users:manage
     *
     * @param UserUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function updateUser(
        string $userId,
        UserUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): UserPublicWithAttributes {
        $response = $this->client->request(
            'PATCH',
            Endpoint::USERS_BY_USER_ID,
            path: ['user_id' => $userId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): UserPublicWithAttributes => UserPublicWithAttributes::fromArray($data));
    }

    /**
     * Delete a user
     *
     * Delete a user by ID
     *
     * Required permissions: users:delete
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteUser(string $userId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::USERS_BY_USER_ID,
            path: ['user_id' => $userId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Get user permissions
     *
     * Get the permissions for a user
     *
     * Required permissions: users:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getUserPermissions(string $userId, ?string $xDatetimeFormat = null): PublicPermissionSet
    {
        $response = $this->client->request(
            'GET',
            Endpoint::USERS_BY_USER_ID_PERMISSIONS,
            path: ['user_id' => $userId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicPermissionSet => PublicPermissionSet::fromArray($data));
    }

    /**
     * Get user role
     *
     * Get the role for a user
     *
     * Required permissions: users:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getRole(string $userId, ?string $xDatetimeFormat = null): PublicRoleAssignment
    {
        $response = $this->client->request(
            'GET',
            Endpoint::USERS_BY_USER_ID_ROLE,
            path: ['user_id' => $userId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicRoleAssignment => PublicRoleAssignment::fromArray($data));
    }

    /**
     * Set user role
     *
     * Set the role for a user, replacing any existing role. Accepts a built-in role name or the label of a
     * custom role owned by the user's organization
     *
     * @param PublicRoleAssignmentRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function setUserRole(
        string $userId,
        PublicRoleAssignmentRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): PublicRoleAssignment {
        $response = $this->client->request(
            'PUT',
            Endpoint::USERS_BY_USER_ID_ROLE,
            path: ['user_id' => $userId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PublicRoleAssignment => PublicRoleAssignment::fromArray($data));
    }
}
