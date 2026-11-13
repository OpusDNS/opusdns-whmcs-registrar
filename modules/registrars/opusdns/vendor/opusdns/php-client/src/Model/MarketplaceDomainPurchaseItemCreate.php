<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\MarketplaceName;
use OpusDNS\Client\Serializer;

/**
 * Buy a domain listed on a marketplace.
 */
final class MarketplaceDomainPurchaseItemCreate implements ApiModel
{
    /**
     * @param string $domain Domain name to buy (Unicode or ASCII form)
     * @param string $expectedPrice The price the customer expects to pay in the organization's billing currency, as
     *     returned by the marketplace search, as a decimal string with two decimals. The order is refused with a
     *     price-changed error when the current price differs.
     * @param MarketplaceName|string $marketplace Marketplace the domain is bought on
     * @param string $type Item type
     */
    public function __construct(
        public readonly string $domain,
        public readonly string $expectedPrice,
        public readonly MarketplaceName|string $marketplace,
        public readonly string $type = 'marketplace_domain_purchase',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            domain: $data['domain'],
            expectedPrice: $data['expected_price'],
            marketplace: MarketplaceName::tryFrom($data['marketplace']) ?? $data['marketplace'],
            type: $data['type'] ?? 'marketplace_domain_purchase',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'domain' => $this->domain,
            'expected_price' => $this->expectedPrice,
            'marketplace' => $this->marketplace,
            'type' => $this->type,
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
