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
     * @param bool $partial True when the counts are not those of the whole bucket: `covered_from`..`covered_to` is
     *     shorter than `period_start`..`period_end` because the window, the start of the event log or today cuts it;
     *     it includes the day of `data_available_from`, which the log covers only from that instant unless it is
     *     midnight; or it reaches today, which is still running. Also true for a bucket that is not covered, which
     *     has no counts. A partial bucket must not be read as a rise or fall against its neighbours
     * @param \DateTimeImmutable $periodEnd Last day of the bucket (UTC): the day itself, the Sunday of its week, or
     *     the last day of its month
     * @param \DateTimeImmutable $periodStart First day of the bucket (UTC)
     * @param \DateTimeImmutable|null $coveredFrom First day the bucket's counts include: the latest of
     *     `period_start`, `start_date` and the day of `data_available_from`. Null when the bucket is not covered:
     *     none of its days lies within the window, on or after the day of `data_available_from` and on or before
     *     today (UTC)
     * @param \DateTimeImmutable|null $coveredTo Last day the bucket's counts include: the earliest of `period_end`,
     *     `end_date` and today (UTC). Null when the bucket is not covered
     * @param int|null $create Domains created from `covered_from` to `covered_to`; 0 when none were. Null when the
     *     bucket is not covered: no data, rather than no movement
     * @param int|null $delete Domains deleted. Null when the bucket is not covered: no data, rather than no movement
     * @param int|null $net Created plus transferred in, minus deleted and transferred out. Null when the bucket is
     *     not covered: no data, rather than no movement
     * @param int|null $renew Domain renewals. Null when the bucket is not covered: no data, rather than no movement
     * @param int|null $restore Domains restored. Null when the bucket is not covered: no data, rather than no
     *     movement
     * @param int|null $transfer Domains transferred in. Null when the bucket is not covered: no data, rather than no
     *     movement
     * @param int|null $transferOut Domains transferred away. Null when the bucket is not covered: no data, rather
     *     than no movement
     */
    public function __construct(
        public bool $partial,
        public \DateTimeImmutable $periodEnd,
        public \DateTimeImmutable $periodStart,
        public ?\DateTimeImmutable $coveredFrom = null,
        public ?\DateTimeImmutable $coveredTo = null,
        public ?int $create = null,
        public ?int $delete = null,
        public ?int $net = null,
        public ?int $renew = null,
        public ?int $restore = null,
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
            partial: $data['partial'],
            periodEnd: Serializer::parseDate($data['period_end']),
            periodStart: Serializer::parseDate($data['period_start']),
            coveredFrom: isset($data['covered_from']) ? Serializer::parseDate($data['covered_from']) : null,
            coveredTo: isset($data['covered_to']) ? Serializer::parseDate($data['covered_to']) : null,
            create: $data['create'] ?? null,
            delete: $data['delete'] ?? null,
            net: $data['net'] ?? null,
            renew: $data['renew'] ?? null,
            restore: $data['restore'] ?? null,
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
            'partial' => $this->partial,
            'period_end' => $this->periodEnd->format('Y-m-d'),
            'period_start' => $this->periodStart->format('Y-m-d'),
            'covered_from' => $this->coveredFrom === null ? null : $this->coveredFrom->format('Y-m-d'),
            'covered_to' => $this->coveredTo === null ? null : $this->coveredTo->format('Y-m-d'),
            'create' => $this->create,
            'delete' => $this->delete,
            'net' => $this->net,
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
