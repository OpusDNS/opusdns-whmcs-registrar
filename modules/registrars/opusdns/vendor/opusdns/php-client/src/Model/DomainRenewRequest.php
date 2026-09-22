<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainRenewRequest implements ApiModel
{
    /**
     * @param \DateTimeImmutable $currentExpiryDate Current expiration date of the domain for validation
     * @param DomainPeriod $period How long to extend the domain registration
     * @param string|null $expectedPrice Expected price for premium domain confirmation
     */
    public function __construct(
        public \DateTimeImmutable $currentExpiryDate,
        public DomainPeriod $period,
        public ?string $expectedPrice = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            currentExpiryDate: new \DateTimeImmutable($data['current_expiry_date']),
            period: DomainPeriod::fromArray($data['period']),
            expectedPrice: $data['expected_price'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'current_expiry_date' => $this->currentExpiryDate,
            'period' => $this->period,
            'expected_price' => $this->expectedPrice,
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
