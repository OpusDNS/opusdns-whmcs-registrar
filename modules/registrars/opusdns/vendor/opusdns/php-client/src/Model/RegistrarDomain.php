<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class RegistrarDomain implements ApiModel
{
    /**
     * @param array<string, RegistrarContact> $contacts
     * @param list<RegistrarContact> $contactsDedup
     * @param list<RegistrarNameserver> $nameservers
     * @param list<string>|null $statuses
     */
    public function __construct(
        public string $name,
        public array $contacts = [],
        public array $contactsDedup = [],
        public ?string $expiryDate = null,
        public array $nameservers = [],
        public ?string $registrar = null,
        public ?array $statuses = null,
        public ?RegistrarZone $zone = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            contacts: isset($data['contacts']) ? array_map(static fn (array $value): RegistrarContact => RegistrarContact::fromArray($value), (array) $data['contacts']) : [],
            contactsDedup: isset($data['contacts_dedup']) ? array_map(static fn (array $item): RegistrarContact => RegistrarContact::fromArray($item), $data['contacts_dedup']) : [],
            expiryDate: $data['expiry_date'] ?? null,
            nameservers: isset($data['nameservers']) ? array_map(static fn (array $item): RegistrarNameserver => RegistrarNameserver::fromArray($item), $data['nameservers']) : [],
            registrar: $data['registrar'] ?? null,
            statuses: $data['statuses'] ?? null,
            zone: isset($data['zone']) ? RegistrarZone::fromArray($data['zone']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'contacts' => ($this->contacts === [] ? new \stdClass() : $this->contacts),
            'contacts_dedup' => $this->contactsDedup,
            'expiry_date' => $this->expiryDate,
            'nameservers' => $this->nameservers,
            'registrar' => $this->registrar,
            'statuses' => $this->statuses,
            'zone' => $this->zone,
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
