<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZoneRrsetsCreate implements ApiModel
{
    /**
     * @param list<DnsRrsetCreate>|null $rrsets
     */
    public function __construct(
        public ?array $rrsets = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            rrsets: isset($data['rrsets']) ? array_map(static fn (array $item): DnsRrsetCreate => DnsRrsetCreate::fromArray($item), $data['rrsets']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
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
