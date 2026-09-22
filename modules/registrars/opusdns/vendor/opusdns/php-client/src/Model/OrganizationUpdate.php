<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class OrganizationUpdate implements ApiModel
{
    /**
     * @param string|null $address1 First line of the organization's address.
     * @param string|null $address2 Second line of the organization's address.
     * @param string|null $businessNumber Government issued business identifier for the organization issued.
     * @param string|null $city City of the organization's address.
     * @param string|null $defaultLocale Default locale for the organization.
     * @param string|null $name Name of the organization.
     * @param string|null $postalCode Postal code of the organization's address.
     * @param string|null $state State or province of the organization's address.
     * @param string|null $taxId Tax ID of the organization.
     * @param string|null $taxIdType Type of tax ID for the organization.
     * @param float|string|null $taxRate Tax rate for the organization.
     */
    public function __construct(
        public ?string $address1 = null,
        public ?string $address2 = null,
        public ?string $businessNumber = null,
        public ?string $city = null,
        public ?string $countryCode = null,
        public ?string $defaultLocale = null,
        public ?string $name = null,
        public ?string $postalCode = null,
        public ?string $state = null,
        public ?string $taxId = null,
        public ?string $taxIdType = null,
        public float|string|null $taxRate = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            address1: $data['address_1'] ?? null,
            address2: $data['address_2'] ?? null,
            businessNumber: $data['business_number'] ?? null,
            city: $data['city'] ?? null,
            countryCode: $data['country_code'] ?? null,
            defaultLocale: $data['default_locale'] ?? null,
            name: $data['name'] ?? null,
            postalCode: $data['postal_code'] ?? null,
            state: $data['state'] ?? null,
            taxId: $data['tax_id'] ?? null,
            taxIdType: $data['tax_id_type'] ?? null,
            taxRate: $data['tax_rate'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'address_1' => $this->address1,
            'address_2' => $this->address2,
            'business_number' => $this->businessNumber,
            'city' => $this->city,
            'country_code' => $this->countryCode,
            'default_locale' => $this->defaultLocale,
            'name' => $this->name,
            'postal_code' => $this->postalCode,
            'state' => $this->state,
            'tax_id' => $this->taxId,
            'tax_id_type' => $this->taxIdType,
            'tax_rate' => $this->taxRate,
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
