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

final readonly class DnsZoneCreate implements ApiModel
{
    /**
     * @param list<DnsRrsetCreate>|null $rrsets
     * @param string|null $vanityNameserverSetId Optional vanity NS set to brand this zone's apex NS + SOA with. When
     *     omitted, the org's default ACTIVE set (if any) is used; when no default exists the system default NS is
     *     used.
     */
    public function __construct(
        public string $name,
        public DnssecStatus|string $dnssecStatus = DnssecStatus::DISABLED,
        public ?array $rrsets = null,
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
            dnssecStatus: isset($data['dnssec_status']) ? DnssecStatus::tryFrom($data['dnssec_status']) ?? $data['dnssec_status'] : DnssecStatus::DISABLED,
            rrsets: isset($data['rrsets']) ? array_map(static fn (array $item): DnsRrsetCreate => DnsRrsetCreate::fromArray($item), $data['rrsets']) : null,
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
            'dnssec_status' => $this->dnssecStatus,
            'rrsets' => $this->rrsets,
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
