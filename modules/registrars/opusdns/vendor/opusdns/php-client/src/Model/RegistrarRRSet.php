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
 * A DNS record set from an external registrar or `GET /v1/dns`.
 *
 * Shaped like `DnsRrsetResponse`: MX and SRV values start with their priority.
 */
final class RegistrarRRSet implements ApiModel
{
    /**
     * @param list<RegistrarRecord> $records
     */
    public function __construct(
        public readonly string $name,
        public readonly int $ttl,
        public readonly string $type,
        public readonly array $records = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            ttl: $data['ttl'],
            type: $data['type'],
            records: isset($data['records']) ? array_map(static fn (array $item): RegistrarRecord => RegistrarRecord::fromArray($item), $data['records']) : [],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'ttl' => $this->ttl,
            'type' => $this->type,
            'records' => $this->records,
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
