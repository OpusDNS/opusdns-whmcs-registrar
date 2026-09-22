<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactCreate implements ApiModel
{
    /**
     * @param string $city The city of the contact
     * @param string $country The country of the contact (ISO 3166-1 alpha-2, plus XK for Kosovo)
     * @param bool $disclose Whether the contact details should be disclosed. The Disclose function may not work with
     *     all TLDs. Some registries still display the data in Whois if, for example, the organization field is
     *     filled in.
     * @param string $email Contact email address (as submitted)
     * @param string $firstName The first name of the contact
     * @param string $lastName The last name of the contact
     * @param string $phone The contact's phone number
     * @param string $postalCode The postal code of the contact
     * @param string $street The address of the contact
     * @param string|null $fax The contacts's fax number
     * @param string|null $org The organization of the contact
     * @param string|null $state The state of the contact
     * @param string|null $title The title of the contact
     */
    public function __construct(
        public string $city,
        public string $country,
        public bool $disclose,
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $phone,
        public string $postalCode,
        public string $street,
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
            country: $data['country'],
            disclose: $data['disclose'],
            email: $data['email'],
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            phone: $data['phone'],
            postalCode: $data['postal_code'],
            street: $data['street'],
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
            'country' => $this->country,
            'disclose' => $this->disclose,
            'email' => $this->email,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'postal_code' => $this->postalCode,
            'street' => $this->street,
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
