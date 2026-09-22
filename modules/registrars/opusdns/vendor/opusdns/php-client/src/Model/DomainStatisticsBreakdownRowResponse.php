<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainStatisticsBreakdownRowResponse implements ApiModel
{
    /**
     * @param string $key Organization id, or the TLD without the leading dot
     * @param int $net Created plus transferred in, minus deleted and transferred out
     * @param int $total Created plus transferred
     * @param string|null $label Organization name; absent for TLD rows
     */
    public function __construct(
        public int $create,
        public int $delete,
        public string $key,
        public int $net,
        public int $renew,
        public int $restore,
        public int $total,
        public int $transfer,
        public int $transferOut,
        public ?string $label = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            create: $data['create'],
            delete: $data['delete'],
            key: $data['key'],
            net: $data['net'],
            renew: $data['renew'],
            restore: $data['restore'],
            total: $data['total'],
            transfer: $data['transfer'],
            transferOut: $data['transfer_out'],
            label: $data['label'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'create' => $this->create,
            'delete' => $this->delete,
            'key' => $this->key,
            'net' => $this->net,
            'renew' => $this->renew,
            'restore' => $this->restore,
            'total' => $this->total,
            'transfer' => $this->transfer,
            'transfer_out' => $this->transferOut,
            'label' => $this->label,
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
