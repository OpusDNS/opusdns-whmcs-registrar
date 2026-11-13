<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\BillingMode;
use OpusDNS\Client\Enum\Currency;
use OpusDNS\Client\Serializer;

final class SignupOrganizationCreate implements ApiModel
{
    /**
     * @param string $countryCode ISO 3166-1 alpha-2 country code, plus XK (Kosovo).
     * @param string $name Name of the organization.
     * @param string|null $address1 First line of the organization's address.
     * @param string|null $address2 Second line of the organization's address.
     * @param list<OrganizationAttributeCreate>|null $attributes List of attributes for the organization.
     * @param BillingMode|string $billingMode Whether the organization is billed on its own account (INDEPENDENT) or
     *     rolled up to its parent (CONSOLIDATED). INDEPENDENT is only permitted for eligible sub-organizations.
     *     Cannot be changed after creation.
     * @param string|null $businessNumber Government issued business identifier for the organization issued.
     * @param string|null $city City of the organization's address.
     * @param Currency|string|null $currency The currency used by the organization.
     * @param string|null $defaultLocale Default locale for the organization.
     * @param string|null $parentOrganizationId ID of the parent organization.
     * @param string|null $postalCode Postal code of the organization's address.
     * @param string|null $state State or province of the organization's address.
     * @param string|null $taxId Tax ID of the organization.
     * @param string|null $taxIdType Type of tax ID for the organization.
     * @param float|string|null $taxRate Tax rate for the organization.
     * @param list<UserCreate>|null $users List of users that needs to be created with the organization.
     */
    public function __construct(
        public readonly string $countryCode,
        public readonly string $name,
        public readonly ?string $address1 = null,
        public readonly ?string $address2 = null,
        public readonly ?array $attributes = null,
        public readonly BillingMode|string $billingMode = BillingMode::CONSOLIDATED,
        public readonly ?string $businessNumber = null,
        public readonly ?string $city = null,
        public readonly Currency|string|null $currency = null,
        public readonly ?string $defaultLocale = null,
        public readonly ?string $parentOrganizationId = null,
        public readonly ?string $postalCode = null,
        public readonly ?string $state = null,
        public readonly ?string $taxId = null,
        public readonly ?string $taxIdType = null,
        public readonly float|string|null $taxRate = null,
        public readonly ?array $users = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            countryCode: $data['country_code'],
            name: $data['name'],
            address1: $data['address_1'] ?? null,
            address2: $data['address_2'] ?? null,
            attributes: isset($data['attributes']) ? array_map(static fn (array $item): OrganizationAttributeCreate => OrganizationAttributeCreate::fromArray($item), $data['attributes']) : null,
            billingMode: isset($data['billing_mode']) ? BillingMode::tryFrom($data['billing_mode']) ?? $data['billing_mode'] : BillingMode::CONSOLIDATED,
            businessNumber: $data['business_number'] ?? null,
            city: $data['city'] ?? null,
            currency: isset($data['currency']) ? Currency::tryFrom($data['currency']) ?? $data['currency'] : null,
            defaultLocale: $data['default_locale'] ?? null,
            parentOrganizationId: $data['parent_organization_id'] ?? null,
            postalCode: $data['postal_code'] ?? null,
            state: $data['state'] ?? null,
            taxId: $data['tax_id'] ?? null,
            taxIdType: $data['tax_id_type'] ?? null,
            taxRate: $data['tax_rate'] ?? null,
            users: isset($data['users']) ? array_map(static fn (array $item): UserCreate => UserCreate::fromArray($item), $data['users']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'country_code' => $this->countryCode,
            'name' => $this->name,
            'address_1' => $this->address1,
            'address_2' => $this->address2,
            'attributes' => $this->attributes,
            'billing_mode' => $this->billingMode,
            'business_number' => $this->businessNumber,
            'city' => $this->city,
            'currency' => $this->currency,
            'default_locale' => $this->defaultLocale,
            'parent_organization_id' => $this->parentOrganizationId,
            'postal_code' => $this->postalCode,
            'state' => $this->state,
            'tax_id' => $this->taxId,
            'tax_id_type' => $this->taxIdType,
            'tax_rate' => $this->taxRate,
            'users' => $this->users,
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
