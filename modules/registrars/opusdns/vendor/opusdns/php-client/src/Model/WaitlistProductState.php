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
 * A waitlisted product, and where your own application for it stands.
 */
final readonly class WaitlistProductState implements ApiModel
{
    /**
     * @param bool $canApply Whether an apply from you would be accepted right now; false for an API key
     * @param string $description What the product does
     * @param string $displayName Human-readable product name
     * @param WaitlistProduct|string $product Product key, used in the apply path
     * @param \DateTimeImmutable|null $appliedOn When you applied, if you have
     * @param \DateTimeImmutable|null $decidedOn When your application was decided, if it was
     * @param WaitlistEntryStatus|string|null $status Where your application stands; null until you apply, and for an
     *     API key
     */
    public function __construct(
        public bool $canApply,
        public string $description,
        public string $displayName,
        public WaitlistProduct|string $product,
        public ?\DateTimeImmutable $appliedOn = null,
        public ?\DateTimeImmutable $decidedOn = null,
        public WaitlistEntryStatus|string|null $status = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            canApply: $data['can_apply'],
            description: $data['description'],
            displayName: $data['display_name'],
            product: WaitlistProduct::tryFrom($data['product']) ?? $data['product'],
            appliedOn: isset($data['applied_on']) ? new \DateTimeImmutable($data['applied_on']) : null,
            decidedOn: isset($data['decided_on']) ? new \DateTimeImmutable($data['decided_on']) : null,
            status: isset($data['status']) ? WaitlistEntryStatus::tryFrom($data['status']) ?? $data['status'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'can_apply' => $this->canApply,
            'description' => $this->description,
            'display_name' => $this->displayName,
            'product' => $this->product,
            'applied_on' => $this->appliedOn,
            'decided_on' => $this->decidedOn,
            'status' => $this->status,
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
