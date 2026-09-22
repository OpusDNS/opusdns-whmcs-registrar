<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\Currency;
use OpusDNS\Client\Serializer;

final readonly class ParkingMetricsResponse implements ApiModel
{
    /**
     * @param ParkingStatistics $metrics Metrics for the parking entry
     * @param string $renewalCost Yearly renewal cost for the parked domain
     * @param Currency|string $renewalCostCurrency Currency code for renewal cost (e.g., USD, EUR)
     * @param string $revenueProgress Revenue progress percentage towards covering renewal cost
     */
    public function __construct(
        public ParkingStatistics $metrics,
        public string $renewalCost,
        public Currency|string $renewalCostCurrency,
        public string $revenueProgress,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            metrics: ParkingStatistics::fromArray($data['metrics']),
            renewalCost: $data['renewal_cost'],
            renewalCostCurrency: Currency::tryFrom($data['renewal_cost_currency']) ?? $data['renewal_cost_currency'],
            revenueProgress: $data['revenue_progress'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'metrics' => $this->metrics,
            'renewal_cost' => $this->renewalCost,
            'renewal_cost_currency' => $this->renewalCostCurrency,
            'revenue_progress' => $this->revenueProgress,
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
