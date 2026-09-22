<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactCreateBulkInstance implements ApiModel
{
    /**
     * @param string $city City
     * @param string $email Email address of the contact
     * @param string $firstName First name of the contact
     * @param string $lastName Last name of the contact
     * @param string $phone Phone number in international format
     * @param string $postalCode Postal code
     * @param string $street Street address
     * @param string|null $country Override country for this contact
     * @param bool|null $disclose Override disclose setting for this contact
     * @param string|null $fax Fax number in international format
     * @param string|null $org Override organization for this contact
     * @param string|null $state Override state for this contact
     * @param string|null $title Override title for this contact
     */
    public function __construct(
        public string $city,
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $phone,
        public string $postalCode,
        public string $street,
        public ?string $country = null,
        public ?bool $disclose = null,
        public ?string $fax = null,
        public ?string $org = null,
        public ?string $state = null,
        public ?string $title = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            city: $data['city'],
            email: $data['email'],
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            phone: $data['phone'],
            postalCode: $data['postal_code'],
            street: $data['street'],
            country: $data['country'] ?? null,
            disclose: $data['disclose'] ?? null,
            fax: $data['fax'] ?? null,
            org: $data['org'] ?? null,
            state: $data['state'] ?? null,
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
            'email' => $this->email,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'postal_code' => $this->postalCode,
            'street' => $this->street,
            'country' => $this->country,
            'disclose' => $this->disclose,
            'fax' => $this->fax,
            'org' => $this->org,
            'state' => $this->state,
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
