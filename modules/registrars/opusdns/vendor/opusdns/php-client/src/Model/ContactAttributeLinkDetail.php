<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactAttributeLinkDetail implements ApiModel
{
    /**
     * @param array<string, string> $attributes The attributes from the linked set
     * @param string $contactAttributeSetId The attribute set linked to the contact TypeID prefix:
     *     contact_attribute_set.
     * @param string $label The label of the linked attribute set
     * @param string $tld The TLD this link applies to
     */
    public function __construct(
        public array $attributes,
        public string $contactAttributeSetId,
        public string $label,
        public string $tld,
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
            label: $data['label'],
            tld: $data['tld'],
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
            'label' => $this->label,
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
