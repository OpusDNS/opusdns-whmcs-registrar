<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\MarketplaceDomainPurchasePublicStage;
use OpusDNS\Client\Enum\MarketplaceName;
use OpusDNS\Client\Serializer;

/**
 * The `marketplace_domain_purchase` part of an item.
 */
final class MarketplaceDomainPurchaseDetail implements ApiModel
{
    /**
     * @param string $domain Domain name (ASCII form)
     * @param MarketplaceName|string $marketplace Marketplace the domain is bought on. More can be added.
     * @param MarketplaceDomainPurchasePublicStage|string $stage Where the purchase stands. Treat a value you do not
     *     know as `processing`: stages can be added.
     */
    public function __construct(
        public readonly string $domain,
        public readonly MarketplaceName|string $marketplace,
        public readonly MarketplaceDomainPurchasePublicStage|string $stage,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            domain: $data['domain'],
            marketplace: MarketplaceName::tryFrom($data['marketplace']) ?? $data['marketplace'],
            stage: MarketplaceDomainPurchasePublicStage::tryFrom($data['stage']) ?? $data['stage'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'domain' => $this->domain,
            'marketplace' => $this->marketplace,
            'stage' => $this->stage,
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
