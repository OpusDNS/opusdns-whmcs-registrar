<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class DomainSearchSuggestionWithPrice implements ApiModel
{
    /**
     * @param DomainAmsAccountResponse|null $connectedAccount Set when the organization registers this TLD on its own
     *     registry accreditation (`ams`). The registry bills the domain to that accreditation, so `price` and
     *     `renewal_price` are the OpusDNS service fee alone, premium or not. Null for TLDs registered on OpusDNS
     *     registry accounts.
     * @param Marketplace|null $marketplace Set on a domain for sale on a marketplace, added to the suggestions with
     *     `available: false`; null on suggestions. On such an item `price.amount` is the price to acquire the domain
     *     from the marketplace (for 1 year, in the listing's currency; it does not include a transfer, which the
     *     customer does with the auth code and is charged separately; null when the domain could not be priced), and
     *     `renewal_price` is the TLD's standard renewal price. A domain can appear twice: as a suggestion with its
     *     registry fields, and as a marketplace item.
     */
    public function __construct(
        public readonly bool $available,
        public readonly string $domain,
        public readonly bool $premium,
        public readonly DomainSearchSuggestionPriceData $price,
        public readonly ?DomainAmsAccountResponse $connectedAccount = null,
        public readonly ?Marketplace $marketplace = null,
        public readonly ?DomainSearchSuggestionPriceData $renewalPrice = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            available: $data['available'],
            domain: $data['domain'],
            premium: $data['premium'],
            price: DomainSearchSuggestionPriceData::fromArray($data['price']),
            connectedAccount: isset($data['connected_account']) ? DomainAmsAccountResponse::fromArray($data['connected_account']) : null,
            marketplace: isset($data['marketplace']) ? Marketplace::fromArray($data['marketplace']) : null,
            renewalPrice: isset($data['renewal_price']) ? DomainSearchSuggestionPriceData::fromArray($data['renewal_price']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'available' => $this->available,
            'domain' => $this->domain,
            'premium' => $this->premium,
            'price' => $this->price,
            'connected_account' => $this->connectedAccount,
            'marketplace' => $this->marketplace,
            'renewal_price' => $this->renewalPrice,
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
