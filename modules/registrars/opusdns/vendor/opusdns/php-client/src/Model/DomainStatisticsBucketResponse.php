<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainStatisticsBucketResponse implements ApiModel
{
    /**
     * @param int $create Domains created in this bucket
     * @param int $delete Domains deleted in this bucket
     * @param int $net Created plus transferred in, minus deleted and transferred out
     * @param bool $partial The bucket reaches outside the requested window, so its counts cover only part of its
     *     span and must not be read as a rise or fall against its neighbours
     * @param \DateTimeImmutable $periodStart First day of the bucket (UTC)
     * @param int $renew Domain renewals in this bucket
     * @param int $restore Domains restored in this bucket
     * @param int $transfer Domains transferred in during this bucket
     * @param int $transferOut Domains transferred away during this bucket
     */
    public function __construct(
        public int $create,
        public int $delete,
        public int $net,
        public bool $partial,
        public \DateTimeImmutable $periodStart,
        public int $renew,
        public int $restore,
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
            partial: $data['partial'],
            periodStart: Serializer::parseDate($data['period_start']),
            renew: $data['renew'],
            restore: $data['restore'],
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
            'partial' => $this->partial,
            'period_start' => $this->periodStart->format('Y-m-d'),
            'renew' => $this->renew,
            'restore' => $this->restore,
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
