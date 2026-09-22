<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainContactType;
use OpusDNS\Client\Serializer;

final readonly class DomainContactResponse implements ApiModel
{
    /**
     * @param string $contactId The contact id of the contact TypeID prefix: contact.
     * @param DomainContactType|string $contactType The type of contact
     * @param array<string, string>|null $attributes Registry-specific attributes supplied inline for this contact in
     *     this role. Omitted when the contact was submitted without inline attributes; attributes taken from a
     *     linked contact attribute set are not reported here.
     */
    public function __construct(
        public string $contactId,
        public DomainContactType|string $contactType,
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
            contactType: DomainContactType::tryFrom($data['contact_type']) ?? $data['contact_type'],
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
            'contact_type' => $this->contactType,
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
