<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\PeriodUnit;
use OpusDNS\Client\Serializer;

final readonly class DomainPeriod implements ApiModel
{
    /**
     * @param PeriodUnit|string $unit The unit of the period
     * @param int $value Amount of time in the unit
     */
    public function __construct(
        public PeriodUnit|string $unit,
        public int $value,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            unit: PeriodUnit::tryFrom($data['unit']) ?? $data['unit'],
            value: $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'unit' => $this->unit,
            'value' => $this->value,
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
