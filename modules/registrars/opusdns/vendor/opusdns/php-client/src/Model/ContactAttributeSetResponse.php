<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactAttributeSetResponse implements ApiModel
{
    /**
     * @param array<string, string> $attributes Key-value map of contact attributes for this set
     * @param string $contactAttributeSetId The unique identifier of the attribute set TypeID prefix:
     *     contact_attribute_set.
     * @param \DateTimeImmutable $createdOn The date/time the entry was created on
     * @param string $label A human-readable label explaining the purpose of this attribute set
     * @param string $organizationId The organization that owns this attribute set TypeID prefix: organization.
     * @param string $tld The TLD this attribute set applies to
     * @param \DateTimeImmutable $updatedOn The date/time the entry was last updated on
     * @param int $linkedContacts Number of contacts linked to this attribute set
     */
    public function __construct(
        public array $attributes,
        public string $contactAttributeSetId,
        public \DateTimeImmutable $createdOn,
        public string $label,
        public string $organizationId,
        public string $tld,
        public \DateTimeImmutable $updatedOn,
        public int $linkedContacts = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            attributes: (array) $data['attributes'],
            contactAttributeSetId: $data['contact_attribute_set_id'],
            createdOn: new \DateTimeImmutable($data['created_on']),
            label: $data['label'],
            organizationId: $data['organization_id'],
            tld: $data['tld'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            linkedContacts: $data['linked_contacts'] ?? 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'attributes' => ($this->attributes === [] ? new \stdClass() : $this->attributes),
            'contact_attribute_set_id' => $this->contactAttributeSetId,
            'created_on' => $this->createdOn,
            'label' => $this->label,
            'organization_id' => $this->organizationId,
            'tld' => $this->tld,
            'updated_on' => $this->updatedOn,
            'linked_contacts' => $this->linkedContacts,
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
