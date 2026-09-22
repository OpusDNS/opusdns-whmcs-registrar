<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainRenewResponse implements ApiModel
{
    /**
     * @param string $name The domain name that was renewed
     * @param \DateTimeImmutable $newExpiryDate New expiration date after renewal
     * @param DomainPeriod $periodExtended The period by which the domain was extended
     */
    public function __construct(
        public string $name,
        public \DateTimeImmutable $newExpiryDate,
        public DomainPeriod $periodExtended,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            newExpiryDate: new \DateTimeImmutable($data['new_expiry_date']),
            periodExtended: DomainPeriod::fromArray($data['period_extended']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'new_expiry_date' => $this->newExpiryDate,
            'period_extended' => $this->periodExtended,
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
