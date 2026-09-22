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

final readonly class ParkingStatistics implements ApiModel
{
    /**
     * @param int $conversions Number of conversions
     * @param string $revenue Total revenue
     * @param Currency|string $revenueCurrency Currency code for revenue (e.g., USD, EUR)
     * @param string $rpc Revenue per click
     * @param string $rpm Revenue per mille (thousand views)
     * @param int $views Number of views
     */
    public function __construct(
        public int $conversions,
        public string $revenue,
        public Currency|string $revenueCurrency,
        public string $rpc,
        public string $rpm,
        public int $views,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            conversions: $data['conversions'],
            revenue: $data['revenue'],
            revenueCurrency: Currency::tryFrom($data['revenue_currency']) ?? $data['revenue_currency'],
            rpc: $data['rpc'],
            rpm: $data['rpm'],
            views: $data['views'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'conversions' => $this->conversions,
            'revenue' => $this->revenue,
            'revenue_currency' => $this->revenueCurrency,
            'rpc' => $this->rpc,
            'rpm' => $this->rpm,
            'views' => $this->views,
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
