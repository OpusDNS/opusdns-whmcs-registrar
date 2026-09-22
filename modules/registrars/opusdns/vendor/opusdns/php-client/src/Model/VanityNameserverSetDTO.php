<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class VanityNameserverSetDTO implements ApiModel
{
    /**
     * @param string $name Human-readable name for the vanity NS set
     * @param string $parentDomainName Parent domain used as the apex of the vanity NS zone
     * @param string $setId Stable identifier for the vanity NS set TypeID prefix: vns.
     * @param string $soaRname SOA RNAME used verbatim when creating vanity-branded zones
     * @param list<VanityNameserverDTO>|null $nameservers Nameservers in the set, ordered by position
     */
    public function __construct(
        public string $name,
        public string $parentDomainName,
        public string $setId,
        public string $soaRname,
        public ?array $nameservers = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            parentDomainName: $data['parent_domain_name'],
            setId: $data['set_id'],
            soaRname: $data['soa_rname'],
            nameservers: isset($data['nameservers']) ? array_map(static fn (array $item): VanityNameserverDTO => VanityNameserverDTO::fromArray($item), $data['nameservers']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'parent_domain_name' => $this->parentDomainName,
            'set_id' => $this->setId,
            'soa_rname' => $this->soaRname,
            'nameservers' => $this->nameservers,
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
