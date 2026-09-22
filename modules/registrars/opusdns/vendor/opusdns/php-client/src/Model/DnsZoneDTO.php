<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnssecStatus;
use OpusDNS\Client\Serializer;

final readonly class DnsZoneDTO implements ApiModel
{
    /**
     * @param string $name The zone name (e.g., 'example.com')
     * @param \DateTimeImmutable|null $createdOn Zone creation timestamp
     * @param DnssecStatus|string $dnssecStatus DNSSEC status
     * @param list<DnsRrsetDTO>|null $rrsets List of RRsets in the zone
     * @param \DateTimeImmutable|null $updatedOn Zone last update timestamp
     * @param string|null $vanityNameserverSetId Vanity NS set branding this zone's apex, or null for system default
     *     NS
     */
    public function __construct(
        public string $name,
        public ?\DateTimeImmutable $createdOn = null,
        public DnssecStatus|string $dnssecStatus = DnssecStatus::DISABLED,
        public ?array $rrsets = null,
        public ?\DateTimeImmutable $updatedOn = null,
        public ?string $vanityNameserverSetId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            dnssecStatus: isset($data['dnssec_status']) ? DnssecStatus::tryFrom($data['dnssec_status']) ?? $data['dnssec_status'] : DnssecStatus::DISABLED,
            rrsets: isset($data['rrsets']) ? array_map(static fn (array $item): DnsRrsetDTO => DnsRrsetDTO::fromArray($item), $data['rrsets']) : null,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
            vanityNameserverSetId: $data['vanity_nameserver_set_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'created_on' => $this->createdOn,
            'dnssec_status' => $this->dnssecStatus,
            'rrsets' => $this->rrsets,
            'updated_on' => $this->updatedOn,
            'vanity_nameserver_set_id' => $this->vanityNameserverSetId,
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
