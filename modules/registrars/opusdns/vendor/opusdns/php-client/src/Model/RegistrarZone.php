<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class RegistrarZone implements ApiModel
{
    /**
     * @param list<RegistrarRRSet> $rrsets
     */
    public function __construct(
        public string $name,
        public array $rrsets = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            rrsets: isset($data['rrsets']) ? array_map(static fn (array $item): RegistrarRRSet => RegistrarRRSet::fromArray($item), $data['rrsets']) : [],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
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
