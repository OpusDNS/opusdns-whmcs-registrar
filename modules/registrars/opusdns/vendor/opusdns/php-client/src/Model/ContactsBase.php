<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\PostalAddressType;
use OpusDNS\Client\Enum\RegistrantChangeType;
use OpusDNS\Client\Serializer;

final class ContactsBase implements ApiModel
{
    /**
     * @param bool|null $authinfoRequired Whether the registry requires authinfo for contact creation
     * @param bool $authinfoSupported Whether the registry supports authinfo for contact creation
     * @param bool|null $isThick Whether the registry supports thick contacts
     * @param list<ContactAttributeDefinition>|null $possibleAttributes List of possible attributes that can be set
     *     for this TLD
     * @param bool|null $privacyProxy Whether a privacy service is allowed
     * @param RegistrantChangeType|string|null $registrantChange Whether the registrant changes through an update, a
     *     trade, or manually through our support team
     * @param RegistrantChangePolicyBase|null $registrantChangePolicy Change of registrant policy. When absent, the
     *     defaults of the TLD type apply.
     * @param bool|null $supportCheck Whether the registry supports contact checks
     * @param bool|null $supportClientContactId Whether the registry supports client defined contact ID
     * @param bool|null $supportTransfer Whether the registry supports contact transfer
     * @param list<PostalAddressType|string>|null $supportedPostalTypes Supported postal address types
     * @param list<ContactConfigBase>|null $supportedRoles Supported contact roles
     * @param list<ContactConfigBase>|null $transferSupportedRoles Supported contact roles for transfer operations.
     *     Falls back to supported_roles if not specified.
     * @param list<ContactConfigBase>|null $updateSupportedRoles Supported contact roles for update operations. Falls
     *     back to supported_roles if not specified.
     */
    public function __construct(
        public readonly ?bool $authinfoRequired = null,
        public readonly bool $authinfoSupported = true,
        public readonly ?bool $isThick = null,
        public readonly ?array $possibleAttributes = null,
        public readonly ?bool $privacyProxy = null,
        public readonly RegistrantChangeType|string|null $registrantChange = null,
        public readonly ?RegistrantChangePolicyBase $registrantChangePolicy = null,
        public readonly ?bool $supportCheck = null,
        public readonly ?bool $supportClientContactId = null,
        public readonly ?bool $supportTransfer = null,
        public readonly ?array $supportedPostalTypes = null,
        public readonly ?array $supportedRoles = null,
        public readonly ?array $transferSupportedRoles = null,
        public readonly ?array $updateSupportedRoles = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            authinfoRequired: $data['authinfo_required'] ?? null,
            authinfoSupported: $data['authinfo_supported'] ?? true,
            isThick: $data['is_thick'] ?? null,
            possibleAttributes: isset($data['possible_attributes']) ? array_map(static fn (array $item): ContactAttributeDefinition => ContactAttributeDefinition::fromArray($item), $data['possible_attributes']) : null,
            privacyProxy: $data['privacy_proxy'] ?? null,
            registrantChange: isset($data['registrant_change']) ? RegistrantChangeType::tryFrom($data['registrant_change']) ?? $data['registrant_change'] : null,
            registrantChangePolicy: isset($data['registrant_change_policy']) ? RegistrantChangePolicyBase::fromArray($data['registrant_change_policy']) : null,
            supportCheck: $data['support_check'] ?? null,
            supportClientContactId: $data['support_client_contact_id'] ?? null,
            supportTransfer: $data['support_transfer'] ?? null,
            supportedPostalTypes: isset($data['supported_postal_types']) ? array_map(static fn (string $item): PostalAddressType|string => PostalAddressType::tryFrom($item) ?? $item, $data['supported_postal_types']) : null,
            supportedRoles: isset($data['supported_roles']) ? array_map(static fn (array $item): ContactConfigBase => ContactConfigBase::fromArray($item), $data['supported_roles']) : null,
            transferSupportedRoles: isset($data['transfer_supported_roles']) ? array_map(static fn (array $item): ContactConfigBase => ContactConfigBase::fromArray($item), $data['transfer_supported_roles']) : null,
            updateSupportedRoles: isset($data['update_supported_roles']) ? array_map(static fn (array $item): ContactConfigBase => ContactConfigBase::fromArray($item), $data['update_supported_roles']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'authinfo_required' => $this->authinfoRequired,
            'authinfo_supported' => $this->authinfoSupported,
            'is_thick' => $this->isThick,
            'possible_attributes' => $this->possibleAttributes,
            'privacy_proxy' => $this->privacyProxy,
            'registrant_change' => $this->registrantChange,
            'registrant_change_policy' => $this->registrantChangePolicy,
            'support_check' => $this->supportCheck,
            'support_client_contact_id' => $this->supportClientContactId,
            'support_transfer' => $this->supportTransfer,
            'supported_postal_types' => $this->supportedPostalTypes,
            'supported_roles' => $this->supportedRoles,
            'transfer_supported_roles' => $this->transferSupportedRoles,
            'update_supported_roles' => $this->updateSupportedRoles,
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
