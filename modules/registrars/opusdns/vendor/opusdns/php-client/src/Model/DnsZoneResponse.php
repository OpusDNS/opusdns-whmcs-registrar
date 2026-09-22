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

final readonly class DnsZoneResponse implements ApiModel
{
    /**
     * @param string $dnsZoneId The unique identifier of the zone TypeID prefix: zone.
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param list<DnsRrsetResponse>|null $rrsets
     * @param list<TagEnrichedResponse>|null $tags Tags assigned to this zone. Only included when ?include=tags is
     *     specified.
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     * @param string|null $vanityNameserverSetId Vanity NS set whose apex NS + SOA brand this zone, or null when the
     *     zone uses the system default nameservers.
     */
    public function __construct(
        public string $dnsZoneId,
        public string $name,
        public ?\DateTimeImmutable $createdOn = null,
        public DnssecStatus|string $dnssecStatus = DnssecStatus::DISABLED,
        public ?DomainNameParts $domainParts = null,
        public ?array $rrsets = null,
        public ?array $tags = null,
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
            dnsZoneId: $data['dns_zone_id'],
            name: $data['name'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            dnssecStatus: isset($data['dnssec_status']) ? DnssecStatus::tryFrom($data['dnssec_status']) ?? $data['dnssec_status'] : DnssecStatus::DISABLED,
            domainParts: isset($data['domain_parts']) ? DomainNameParts::fromArray($data['domain_parts']) : null,
            rrsets: isset($data['rrsets']) ? array_map(static fn (array $item): DnsRrsetResponse => DnsRrsetResponse::fromArray($item), $data['rrsets']) : null,
            tags: isset($data['tags']) ? array_map(static fn (array $item): TagEnrichedResponse => TagEnrichedResponse::fromArray($item), $data['tags']) : null,
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
            'dns_zone_id' => $this->dnsZoneId,
            'name' => $this->name,
            'created_on' => $this->createdOn,
            'dnssec_status' => $this->dnssecStatus,
            'domain_parts' => $this->domainParts,
            'rrsets' => $this->rrsets,
            'tags' => $this->tags,
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
