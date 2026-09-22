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

final readonly class DnsRrsetDTO implements ApiModel
{
    /**
     * @param string $name The RRset name (e.g., '@', 'www')
     * @param int $ttl Time to live in seconds
     * @param DnsRrsetType|string $type The RRset type
     * @param list<DnsRecordDTO>|null $records List of records in this RRset
     */
    public function __construct(
        public string $name,
        public int $ttl,
        public DnsRrsetType|string $type,
        public ?array $records = null,
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
            type: DnsRrsetType::tryFrom($data['type']) ?? $data['type'],
            records: isset($data['records']) ? array_map(static fn (array $item): DnsRecordDTO => DnsRecordDTO::fromArray($item), $data['records']) : null,
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
