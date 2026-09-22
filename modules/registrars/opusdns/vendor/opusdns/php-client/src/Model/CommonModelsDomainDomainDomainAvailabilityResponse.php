<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * DomainAvailabilityResponse
 */
final readonly class CommonModelsDomainDomainDomainAvailabilityResponse implements ApiModel
{
    /**
     * @param bool $available True if the domain is available for registration
     * @param string $domain The domain name that was checked
     * @param string|null $claimsKey Trademark claims key returned when the TLD is in its claims phase and the domain
     *     matches a TMCH-registered mark. When present, the corresponding claims notice must be retrieved and
     *     acknowledged before registration.
     * @param DomainAvailabilityError|null $error Error that prevented this domain from being checked:
     *     `validation_error` if the domain name is invalid or its TLD is not supported, `check_error` if the
     *     registry check failed.
     * @param bool $isPremium True if the registry classifies this domain as premium (non-standard pricing)
     * @param PremiumPricingResponse|null $premiumPricing Premium pricing per action (create / renew / transfer /
     *     restore). Present only when `is_premium` is true and the registry returned pricing.
     * @param string|null $reason Registry-supplied reason the domain is unavailable (e.g. 'Domain exists',
     *     'Reserved', 'In Use'). Null if the domain is available, failed prechecks, or no reason was returned by the
     *     registry.
     */
    public function __construct(
        public bool $available,
        public string $domain,
        public ?string $claimsKey = null,
        public ?DomainAvailabilityError $error = null,
        public bool $isPremium = false,
        public ?PremiumPricingResponse $premiumPricing = null,
        public ?string $reason = null,
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
            claimsKey: $data['claims_key'] ?? null,
            error: isset($data['error']) ? DomainAvailabilityError::fromArray($data['error']) : null,
            isPremium: $data['is_premium'] ?? false,
            premiumPricing: isset($data['premium_pricing']) ? PremiumPricingResponse::fromArray($data['premium_pricing']) : null,
            reason: $data['reason'] ?? null,
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
            'claims_key' => $this->claimsKey,
            'error' => $this->error,
            'is_premium' => $this->isPremium,
            'premium_pricing' => $this->premiumPricing,
            'reason' => $this->reason,
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
