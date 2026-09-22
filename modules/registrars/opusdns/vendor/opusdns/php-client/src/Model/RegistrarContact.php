<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class RegistrarContact implements ApiModel
{
    /**
     * @param string|null $id Contact ID (required for OpusDNS-native contacts, may be null for registrar-sourced)
     */
    public function __construct(
        public ?string $city = null,
        public ?string $country = null,
        public ?string $email = null,
        public ?string $fax = null,
        public ?string $firstName = null,
        public ?string $id = null,
        public ?string $lastName = null,
        public ?string $org = null,
        public ?string $phone = null,
        public ?string $postalCode = null,
        public ?string $state = null,
        public ?string $street = null,
        public ?string $title = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            city: $data['city'] ?? null,
            country: $data['country'] ?? null,
            email: $data['email'] ?? null,
            fax: $data['fax'] ?? null,
            firstName: $data['first_name'] ?? null,
            id: $data['id'] ?? null,
            lastName: $data['last_name'] ?? null,
            org: $data['org'] ?? null,
            phone: $data['phone'] ?? null,
            postalCode: $data['postal_code'] ?? null,
            state: $data['state'] ?? null,
            street: $data['street'] ?? null,
            title: $data['title'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'city' => $this->city,
            'country' => $this->country,
            'email' => $this->email,
            'fax' => $this->fax,
            'first_name' => $this->firstName,
            'id' => $this->id,
            'last_name' => $this->lastName,
            'org' => $this->org,
            'phone' => $this->phone,
            'postal_code' => $this->postalCode,
            'state' => $this->state,
            'street' => $this->street,
            'title' => $this->title,
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
