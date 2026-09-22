<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardMetricsRates implements ApiModel
{
    /**
     * @param float $bounceRate Bounce rate percentage
     * @param float $deliveryRate Delivery rate percentage
     * @param float $queuedRate Queued rate percentage
     * @param float $refusedRate Refused rate percentage
     */
    public function __construct(
        public float $bounceRate,
        public float $deliveryRate,
        public float $queuedRate,
        public float $refusedRate,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            bounceRate: $data['bounce_rate'],
            deliveryRate: $data['delivery_rate'],
            queuedRate: $data['queued_rate'],
            refusedRate: $data['refused_rate'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'bounce_rate' => $this->bounceRate,
            'delivery_rate' => $this->deliveryRate,
            'queued_rate' => $this->queuedRate,
            'refused_rate' => $this->refusedRate,
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
