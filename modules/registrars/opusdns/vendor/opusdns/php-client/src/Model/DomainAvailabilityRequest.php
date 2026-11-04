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

final readonly class DomainAvailabilityRequest implements ApiModel
{
    /**
     * @param list<string> $domains
     * @param list<string|MarketplaceName>|null $marketplaces Marketplaces to check, by name, or `all` for every
     *     marketplace. A taken domain that can be bought on one of them is reported as `market_available`.
     *     Best-effort: such a domain may still be reported as `unavailable`. Empty or omitted: no marketplace is
     *     checked.
     */
    public function __construct(
        public array $domains,
        public ?array $marketplaces = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            domains: $data['domains'],
            marketplaces: isset($data['marketplaces']) ? array_map(static fn (mixed $item) => MarketplaceName::tryFrom($item) ?? $item, $data['marketplaces']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'domains' => $this->domains,
            'marketplaces' => $this->marketplaces,
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
