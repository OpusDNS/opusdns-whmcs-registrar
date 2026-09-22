<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnssecRegistryPublishOutcome;
use OpusDNS\Client\Serializer;

final readonly class DnsChangesResponse implements ApiModel
{
    /**
     * @param list<DnsChangeResponse> $changes
     */
    public function __construct(
        public array $changes,
        public int $numChanges,
        public string $zoneName,
        public ?string $changesetId = null,
        public DnssecRegistryPublishOutcome|string|null $dnssecRegistryPublish = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            changes: array_map(static fn (array $item): DnsChangeResponse => DnsChangeResponse::fromArray($item), $data['changes']),
            numChanges: $data['num_changes'],
            zoneName: $data['zone_name'],
            changesetId: $data['changeset_id'] ?? null,
            dnssecRegistryPublish: isset($data['dnssec_registry_publish']) ? DnssecRegistryPublishOutcome::tryFrom($data['dnssec_registry_publish']) ?? $data['dnssec_registry_publish'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'changes' => $this->changes,
            'num_changes' => $this->numChanges,
            'zone_name' => $this->zoneName,
            'changeset_id' => $this->changesetId,
            'dnssec_registry_publish' => $this->dnssecRegistryPublish,
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
