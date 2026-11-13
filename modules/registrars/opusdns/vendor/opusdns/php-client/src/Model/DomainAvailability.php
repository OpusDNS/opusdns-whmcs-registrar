<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainAvailabilityStatus;
use OpusDNS\Client\Serializer;

final class DomainAvailability implements ApiModel
{
    /**
     * @param DomainAvailabilityStatus|string $status `unavailable` also covers reserved and invalid names (see
     *     `error`). Retry `error` and `unknown` later. `tmch_claim` is not returned at present.
     * @param DomainAvailabilityError|null $error Why the domain could not be checked: a `validation_error` (the name
     *     is invalid; status `unavailable`) or a `check_error` (status `error`). Null otherwise; a status `error`
     *     may also come without one.
     * @param Marketplace|null $marketplace The marketplace a taken domain can be bought on; set on
     *     `market_available` results of `POST /v1/availability/stream` with `marketplaces`; null otherwise, or when
     *     the marketplace is not known yet.
     */
    public function __construct(
        public readonly string $domain,
        public readonly DomainAvailabilityStatus|string $status,
        public readonly ?DomainAvailabilityError $error = null,
        public readonly ?Marketplace $marketplace = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            domain: $data['domain'],
            status: DomainAvailabilityStatus::tryFrom($data['status']) ?? $data['status'],
            error: isset($data['error']) ? DomainAvailabilityError::fromArray($data['error']) : null,
            marketplace: isset($data['marketplace']) ? Marketplace::fromArray($data['marketplace']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'domain' => $this->domain,
            'status' => $this->status,
            'error' => $this->error,
            'marketplace' => $this->marketplace,
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
