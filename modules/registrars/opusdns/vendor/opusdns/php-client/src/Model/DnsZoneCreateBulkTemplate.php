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

final readonly class DnsZoneCreateBulkTemplate implements ApiModel
{
    /**
     * @param DnssecStatus|string $dnssecStatus DNSSEC status for all zones
     * @param list<DnsRrsetCreate>|null $rrsets DNS record sets to create
     */
    public function __construct(
        public DnssecStatus|string $dnssecStatus = DnssecStatus::DISABLED,
        public ?array $rrsets = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            dnssecStatus: isset($data['dnssec_status']) ? DnssecStatus::tryFrom($data['dnssec_status']) ?? $data['dnssec_status'] : DnssecStatus::DISABLED,
            rrsets: isset($data['rrsets']) ? array_map(static fn (array $item): DnsRrsetCreate => DnsRrsetCreate::fromArray($item), $data['rrsets']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
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
