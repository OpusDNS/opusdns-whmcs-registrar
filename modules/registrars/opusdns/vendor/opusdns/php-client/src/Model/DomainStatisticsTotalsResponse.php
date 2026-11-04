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
     * @param int|null $create Domains created (newly registered), summed over the covered buckets. Null when no
     *     bucket is covered
     * @param int|null $delete Domains deleted, summed over the covered buckets. Null when no bucket is covered
     * @param int|null $net Created plus transferred in, minus deleted and transferred out, summed over the covered
     *     buckets. Null when no bucket is covered
     * @param int|null $renew Domains renewed, counted once per day a domain was renewed, summed over the covered
     *     buckets. Null when no bucket is covered
     * @param int|null $restore Domains restored from redemption, summed over the covered buckets. Null when no
     *     bucket is covered
     * @param int|null $total Created plus transferred, summed over the covered buckets. Null when no bucket is
     *     covered
     * @param int|null $transfer Domains transferred to OpusDNS, summed over the covered buckets. Null when no bucket
     *     is covered
     * @param int|null $transferOut Domains transferred away from OpusDNS, summed over the covered buckets. Null when
     *     no bucket is covered
     */
    public function __construct(
        public ?int $create = null,
        public ?int $delete = null,
        public ?int $net = null,
        public ?int $renew = null,
        public ?int $restore = null,
        public ?int $total = null,
        public ?int $transfer = null,
        public ?int $transferOut = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            create: $data['create'] ?? null,
            delete: $data['delete'] ?? null,
            net: $data['net'] ?? null,
            renew: $data['renew'] ?? null,
            restore: $data['restore'] ?? null,
            total: $data['total'] ?? null,
            transfer: $data['transfer'] ?? null,
            transferOut: $data['transfer_out'] ?? null,
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
