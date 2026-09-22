<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class UserUpdate implements ApiModel
{
    /**
     * @param string|null $email The user's email address
     * @param string|null $firstName The user's first name
     * @param string|null $lastName The user's last name
     * @param string|null $locale The user's locale
     * @param string|null $phone The user's phone number
     * @param list<UserAttributeBase>|null $userAttributes User attributes
     * @param string|null $username The user's unique username
     */
    public function __construct(
        public ?string $email = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $locale = null,
        public ?string $phone = null,
        public ?array $userAttributes = null,
        public ?string $username = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            email: $data['email'] ?? null,
            firstName: $data['first_name'] ?? null,
            lastName: $data['last_name'] ?? null,
            locale: $data['locale'] ?? null,
            phone: $data['phone'] ?? null,
            userAttributes: isset($data['user_attributes']) ? array_map(static fn (array $item): UserAttributeBase => UserAttributeBase::fromArray($item), $data['user_attributes']) : null,
            username: $data['username'] ?? null,
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
            'phone' => $this->phone,
            'user_attributes' => $this->userAttributes,
            'username' => $this->username,
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
