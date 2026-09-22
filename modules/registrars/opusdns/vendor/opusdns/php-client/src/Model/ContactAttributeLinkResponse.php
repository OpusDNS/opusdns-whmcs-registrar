<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactAttributeLinkResponse implements ApiModel
{
    /**
     * @param string $contactAttributeLinkId The unique identifier of the link TypeID prefix: contact_attribute_link.
     * @param string $contactAttributeSetId The attribute set linked to the contact TypeID prefix:
     *     contact_attribute_set.
     * @param string $contactId The contact this link belongs to TypeID prefix: contact.
     * @param \DateTimeImmutable $createdOn The date/time the entry was created on
     * @param string $tld The TLD this link applies to
     */
    public function __construct(
        public string $contactAttributeLinkId,
        public string $contactAttributeSetId,
        public string $contactId,
        public \DateTimeImmutable $createdOn,
        public string $tld,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            contactAttributeLinkId: $data['contact_attribute_link_id'],
            contactAttributeSetId: $data['contact_attribute_set_id'],
            contactId: $data['contact_id'],
            createdOn: new \DateTimeImmutable($data['created_on']),
            tld: $data['tld'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'contact_attribute_link_id' => $this->contactAttributeLinkId,
            'contact_attribute_set_id' => $this->contactAttributeSetId,
            'contact_id' => $this->contactId,
            'created_on' => $this->createdOn,
            'tld' => $this->tld,
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
