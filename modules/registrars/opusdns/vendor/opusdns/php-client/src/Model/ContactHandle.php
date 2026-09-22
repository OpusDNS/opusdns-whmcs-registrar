<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactHandle implements ApiModel
{
    /**
     * @param string $contactId The contact id of the contact TypeID prefix: contact.
     * @param array<string, string>|null $attributes Additional attributes related to the contact
     */
    public function __construct(
        public string $contactId,
        public ?array $attributes = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            contactId: $data['contact_id'],
            attributes: isset($data['attributes']) ? (array) $data['attributes'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'contact_id' => $this->contactId,
            'attributes' => $this->attributes === null ? null : ($this->attributes === [] ? new \stdClass() : $this->attributes),
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
