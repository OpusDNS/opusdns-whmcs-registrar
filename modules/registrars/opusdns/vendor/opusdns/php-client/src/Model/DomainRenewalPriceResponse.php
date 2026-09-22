<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainRenewalPriceResponse implements ApiModel
{
    /**
     * @param string $currency ISO 4217 currency code
     * @param bool $isPremium True when the price came from the registry's premium classification for renew rather
     *     than from the organization's standard TLD pricing
     * @param DomainPeriod $period Period the price covers
     * @param string $price Renewal price for the period below, in the organization's billing currency, taxes
     *     excluded
     */
    public function __construct(
        public string $currency,
        public bool $isPremium,
        public DomainPeriod $period,
        public string $price,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            currency: $data['currency'],
            isPremium: $data['is_premium'],
            period: DomainPeriod::fromArray($data['period']),
            price: $data['price'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'currency' => $this->currency,
            'is_premium' => $this->isPremium,
            'period' => $this->period,
            'price' => $this->price,
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
