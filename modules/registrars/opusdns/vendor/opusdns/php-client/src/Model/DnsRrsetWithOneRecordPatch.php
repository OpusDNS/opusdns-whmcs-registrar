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

final readonly class DnsRrsetWithOneRecordPatch implements ApiModel
{
    public function __construct(
        public string $name,
        public string $rdata,
        public int $ttl,
        public DnsRrsetType|string $type,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            rdata: $data['rdata'],
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
            'rdata' => $this->rdata,
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
