<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\WaitlistEntryStatus;
use OpusDNS\Client\Enum\WaitlistProduct;
use OpusDNS\Client\Serializer;

/**
 * Your own waitlist application.
 */
final readonly class WaitlistEntryResponse implements ApiModel
{
    /**
     * @param \DateTimeImmutable $appliedOn When you applied
     * @param WaitlistProduct|string $product Product the application is for
     * @param WaitlistEntryStatus|string $status Where the application stands
     * @param \DateTimeImmutable|null $decidedOn When the application was decided; null while it is pending
     */
    public function __construct(
        public \DateTimeImmutable $appliedOn,
        public WaitlistProduct|string $product,
        public WaitlistEntryStatus|string $status,
        public ?\DateTimeImmutable $decidedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            appliedOn: new \DateTimeImmutable($data['applied_on']),
            product: WaitlistProduct::tryFrom($data['product']) ?? $data['product'],
            status: WaitlistEntryStatus::tryFrom($data['status']) ?? $data['status'],
            decidedOn: isset($data['decided_on']) ? new \DateTimeImmutable($data['decided_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'applied_on' => $this->appliedOn,
            'product' => $this->product,
            'status' => $this->status,
            'decided_on' => $this->decidedOn,
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
