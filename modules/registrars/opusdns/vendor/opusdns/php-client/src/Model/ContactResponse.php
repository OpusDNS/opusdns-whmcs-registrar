<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactResponse implements ApiModel
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
     * @param list<ContactAttributeLinkDetail>|null $attributeSets Linked attribute sets for this contact
     * @param string|null $contactId TypeID prefix: contact.
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param string|null $fax The contacts's fax number
     * @param string|null $org The organization of the contact
     * @param string|null $organizationId The organization that owns the domain TypeID prefix: organization.
     * @param string|null $state The state of the contact
     * @param list<StatusTagResponse>|null $statusTags Status tags assigned to this contact. Only included when
     *     ?include=tags is specified.
     * @param list<TagEnrichedResponse>|null $tags Tags assigned to this contact
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
        public ?array $attributeSets = null,
        public ?string $contactId = null,
        public ?\DateTimeImmutable $createdOn = null,
        public ?string $fax = null,
        public ?string $org = null,
        public ?string $organizationId = null,
        public ?string $state = null,
        public ?array $statusTags = null,
        public ?array $tags = null,
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
            attributeSets: isset($data['attribute_sets']) ? array_map(static fn (array $item): ContactAttributeLinkDetail => ContactAttributeLinkDetail::fromArray($item), $data['attribute_sets']) : null,
            contactId: $data['contact_id'] ?? null,
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            fax: $data['fax'] ?? null,
            org: $data['org'] ?? null,
            organizationId: $data['organization_id'] ?? null,
            state: $data['state'] ?? null,
            statusTags: isset($data['status_tags']) ? array_map(static fn (array $item): StatusTagResponse => StatusTagResponse::fromArray($item), $data['status_tags']) : null,
            tags: isset($data['tags']) ? array_map(static fn (array $item): TagEnrichedResponse => TagEnrichedResponse::fromArray($item), $data['tags']) : null,
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
            'attribute_sets' => $this->attributeSets,
            'contact_id' => $this->contactId,
            'created_on' => $this->createdOn,
            'fax' => $this->fax,
            'org' => $this->org,
            'organization_id' => $this->organizationId,
            'state' => $this->state,
            'status_tags' => $this->statusTags,
            'tags' => $this->tags,
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
