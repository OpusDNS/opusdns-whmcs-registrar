<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class UserCreate implements ApiModel
{
    /**
     * @param string $email The user's email address
     * @param string $firstName The user's first name
     * @param string $lastName The user's last name
     * @param string $username The user's unique username
     * @param string|null $password Plaintext password for hashing during creation
     * @param string|null $phone The user's phone number
     * @param list<UserAttributeBase>|null $userAttributes User attributes
     */
    public function __construct(
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $locale,
        public string $username,
        public ?string $password = null,
        public ?string $phone = null,
        public ?array $userAttributes = null,
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
            password: $data['password'] ?? null,
            phone: $data['phone'] ?? null,
            userAttributes: isset($data['user_attributes']) ? array_map(static fn (array $item): UserAttributeBase => UserAttributeBase::fromArray($item), $data['user_attributes']) : null,
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
            'password' => $this->password,
            'phone' => $this->phone,
            'user_attributes' => $this->userAttributes,
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
