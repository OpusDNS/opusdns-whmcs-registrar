<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainStatisticsTotalsResponse implements ApiModel
{
    /**
     * @param int $create Domains created (newly registered) in the window
     * @param int $delete Domains deleted in the window
     * @param int $net Created plus transferred in, minus deleted and transferred out
     * @param int $renew Domains renewed in the window, counted once per day a domain was renewed
     * @param int $restore Domains restored from redemption in the window
     * @param int $total Created plus transferred
     * @param int $transfer Domains transferred to OpusDNS in the window
     * @param int $transferOut Domains transferred away from OpusDNS in the window
     */
    public function __construct(
        public int $create,
        public int $delete,
        public int $net,
        public int $renew,
        public int $restore,
        public int $total,
        public int $transfer,
        public int $transferOut,
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
            net: $data['net'],
            renew: $data['renew'],
            restore: $data['restore'],
            total: $data['total'],
            transfer: $data['transfer'],
            transferOut: $data['transfer_out'],
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
            'net' => $this->net,
            'renew' => $this->renew,
            'restore' => $this->restore,
            'total' => $this->total,
            'transfer' => $this->transfer,
            'transfer_out' => $this->transferOut,
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
