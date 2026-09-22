<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnsChangeAction;
use OpusDNS\Client\Enum\DnsRrsetType;
use OpusDNS\Client\Serializer;

final readonly class DnsChangeResponse implements ApiModel
{
    public function __construct(
        public DnsChangeAction|string $action,
        public ?string $recordData = null,
        public ?string $rrsetName = null,
        public DnsRrsetType|string|null $rrsetType = null,
        public ?int $ttl = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            action: DnsChangeAction::tryFrom($data['action']) ?? $data['action'],
            recordData: $data['record_data'] ?? null,
            rrsetName: $data['rrset_name'] ?? null,
            rrsetType: isset($data['rrset_type']) ? DnsRrsetType::tryFrom($data['rrset_type']) ?? $data['rrset_type'] : null,
            ttl: $data['ttl'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'action' => $this->action,
            'record_data' => $this->recordData,
            'rrset_name' => $this->rrsetName,
            'rrset_type' => $this->rrsetType,
            'ttl' => $this->ttl,
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
