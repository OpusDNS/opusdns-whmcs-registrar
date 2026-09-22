<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnsProtectedReason;
use OpusDNS\Client\Enum\DnsRrsetType;
use OpusDNS\Client\Serializer;

final readonly class DnsRrsetResponse implements ApiModel
{
    /**
     * @param bool $protected Whether the RRset is protected
     * @param DnsProtectedReason|string|null $protectedReason Reason why the RRset is protected
     * @param list<DnsRecordResponse>|null $records
     */
    public function __construct(
        public string $name,
        public int $ttl,
        public DnsRrsetType|string $type,
        public bool $protected = false,
        public DnsProtectedReason|string|null $protectedReason = null,
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
            protected: $data['protected'] ?? false,
            protectedReason: isset($data['protected_reason']) ? DnsProtectedReason::tryFrom($data['protected_reason']) ?? $data['protected_reason'] : null,
            records: isset($data['records']) ? array_map(static fn (array $item): DnsRecordResponse => DnsRecordResponse::fromArray($item), $data['records']) : null,
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
            'protected' => $this->protected,
            'protected_reason' => $this->protectedReason,
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
