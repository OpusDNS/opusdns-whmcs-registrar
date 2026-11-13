<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ContactCompleteness;
use OpusDNS\Client\Serializer;

final class ContactResponse implements ApiModel
{
    /**
     * @param ContactCompleteness|string $completeness Whether the contact passed the contact create validation when
     *     it was stored. Can disagree with `incomplete_fields` if the rules changed since; the `completeness` list
     *     filter uses this.
     * @param bool $disclose Whether the contact details should be disclosed. The Disclose function may not work with
     *     all TLDs. Some registries still display the data in Whois if, for example, the organization field is
     *     filled in.
     * @param list<string> $incompleteFields The fields that fail the contact create validation today; empty when
     *     none do. `contact` stands for a failure that names no single field.
     * @param list<ContactAttributeLinkDetail>|null $attributeSets Linked attribute sets for this contact
     * @param string|null $city The city of the contact
     * @param string|null $contactId TypeID prefix: contact.
     * @param string|null $country The country of the contact (ISO 3166-1 alpha-2, plus XK for Kosovo)
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param string|null $email Contact email address (as submitted)
     * @param string|null $fax The contacts's fax number
     * @param string|null $firstName The first name of the contact
     * @param string|null $lastName The last name of the contact
     * @param string|null $org The organization of the contact
     * @param string|null $organizationId The organization that owns the domain TypeID prefix: organization.
     * @param string|null $phone The contact's phone number
     * @param string|null $postalCode The postal code of the contact
     * @param string|null $state The state of the contact
     * @param list<ContactStatusTagResponse>|null $statusTags Status tags assigned to this contact. Only included
     *     when ?include=tags is specified.
     * @param string|null $street The address of the contact
     * @param list<TagEnrichedResponse>|null $tags Tags assigned to this contact
     * @param string|null $title The title of the contact
     */
    public function __construct(
        public readonly ContactCompleteness|string $completeness,
        public readonly bool $disclose,
        public readonly array $incompleteFields,
        public readonly ?array $attributeSets = null,
        public readonly ?string $city = null,
        public readonly ?string $contactId = null,
        public readonly ?string $country = null,
        public readonly ?\DateTimeImmutable $createdOn = null,
        public readonly ?string $email = null,
        public readonly ?string $fax = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $org = null,
        public readonly ?string $organizationId = null,
        public readonly ?string $phone = null,
        public readonly ?string $postalCode = null,
        public readonly ?string $state = null,
        public readonly ?array $statusTags = null,
        public readonly ?string $street = null,
        public readonly ?array $tags = null,
        public readonly ?string $title = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            completeness: ContactCompleteness::tryFrom($data['completeness']) ?? $data['completeness'],
            disclose: $data['disclose'],
            incompleteFields: $data['incomplete_fields'],
            attributeSets: isset($data['attribute_sets']) ? array_map(static fn (array $item): ContactAttributeLinkDetail => ContactAttributeLinkDetail::fromArray($item), $data['attribute_sets']) : null,
            city: $data['city'] ?? null,
            contactId: $data['contact_id'] ?? null,
            country: $data['country'] ?? null,
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            email: $data['email'] ?? null,
            fax: $data['fax'] ?? null,
            firstName: $data['first_name'] ?? null,
            lastName: $data['last_name'] ?? null,
            org: $data['org'] ?? null,
            organizationId: $data['organization_id'] ?? null,
            phone: $data['phone'] ?? null,
            postalCode: $data['postal_code'] ?? null,
            state: $data['state'] ?? null,
            statusTags: isset($data['status_tags']) ? array_map(static fn (array $item): ContactStatusTagResponse => ContactStatusTagResponse::fromArray($item), $data['status_tags']) : null,
            street: $data['street'] ?? null,
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
            'completeness' => $this->completeness,
            'disclose' => $this->disclose,
            'incomplete_fields' => $this->incompleteFields,
            'attribute_sets' => $this->attributeSets,
            'city' => $this->city,
            'contact_id' => $this->contactId,
            'country' => $this->country,
            'created_on' => $this->createdOn,
            'email' => $this->email,
            'fax' => $this->fax,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'org' => $this->org,
            'organization_id' => $this->organizationId,
            'phone' => $this->phone,
            'postal_code' => $this->postalCode,
            'state' => $this->state,
            'status_tags' => $this->statusTags,
            'street' => $this->street,
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
