<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class TrademarkClaimsBase implements ApiModel
{
    /**
     * @param bool $supported Whether trademark claims are supported
     * @param \DateTimeImmutable|null $endDate End date of trademark claims
     * @param \DateTimeImmutable|null $startDate Start date of trademark claims
     * @param bool|null $tmchRequired If true, claim notifications are mandatory within the timeframe
     */
    public function __construct(
        public bool $supported,
        public ?\DateTimeImmutable $endDate = null,
        public ?\DateTimeImmutable $startDate = null,
        public ?bool $tmchRequired = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            supported: $data['supported'],
            endDate: isset($data['end_date']) ? new \DateTimeImmutable($data['end_date']) : null,
            startDate: isset($data['start_date']) ? new \DateTimeImmutable($data['start_date']) : null,
            tmchRequired: $data['tmch_required'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'supported' => $this->supported,
            'end_date' => $this->endDate,
            'start_date' => $this->startDate,
            'tmch_required' => $this->tmchRequired,
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
