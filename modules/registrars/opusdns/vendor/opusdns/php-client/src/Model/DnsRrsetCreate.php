<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnsRrsetType;
use OpusDNS\Client\Serializer;

final class DnsRrsetCreate implements ApiModel
{
    /**
     * @param list<DnsRecordCreate> $records
     */
    public function __construct(
        public readonly string $name,
        public readonly array $records,
        public readonly int $ttl,
        public readonly DnsRrsetType|string $type,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            records: array_map(static fn (array $item): DnsRecordCreate => DnsRecordCreate::fromArray($item), $data['records']),
            ttl: $data['ttl'],
            type: DnsRrsetType::tryFrom($data['type']) ?? $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'records' => $this->records,
            'ttl' => $this->ttl,
            'type' => $this->type,
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
