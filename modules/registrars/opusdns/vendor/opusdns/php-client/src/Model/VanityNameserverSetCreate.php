<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * Public create request body. The owning org comes from auth context, and the anycast IPs are
 * allocated server-side from `VanityNameserversConfig`, so neither is accepted here.
 */
final readonly class VanityNameserverSetCreate implements ApiModel
{
    /**
     * @param list<string> $hostnames Fully-qualified vanity NS hostnames, ordered by intended position.
     * @param string $name Human-readable name for the set
     * @param string $parentDomainName Apex domain of the vanity NS zone; all hostnames must be subdomains.
     * @param string $soaRname SOA RNAME stamped verbatim into the vanity NS zone
     */
    public function __construct(
        public array $hostnames,
        public string $name,
        public string $parentDomainName,
        public string $soaRname,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            hostnames: $data['hostnames'],
            name: $data['name'],
            parentDomainName: $data['parent_domain_name'],
            soaRname: $data['soa_rname'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'hostnames' => $this->hostnames,
            'name' => $this->name,
            'parent_domain_name' => $this->parentDomainName,
            'soa_rname' => $this->soaRname,
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
