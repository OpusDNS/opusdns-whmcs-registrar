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

final readonly class DnsZoneUpdateBulkInstance implements ApiModel
{
    /**
     * @param string $name The DNS zone name (e.g., example.com)
     * @param DnssecStatus|string|null $dnssecStatus Override DNSSEC status for this zone
     * @param list<DnsRrsetCreate>|null $rrsets Override RRsets for this zone. Omit to inherit the template (or leave
     *     records unchanged if the template also omits rrsets). Provide an empty list to delete all records.
     */
    public function __construct(
        public string $name,
        public DnssecStatus|string|null $dnssecStatus = null,
        public ?array $rrsets = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            dnssecStatus: isset($data['dnssec_status']) ? DnssecStatus::tryFrom($data['dnssec_status']) ?? $data['dnssec_status'] : null,
            rrsets: isset($data['rrsets']) ? array_map(static fn (array $item): DnsRrsetCreate => DnsRrsetCreate::fromArray($item), $data['rrsets']) : null,
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
