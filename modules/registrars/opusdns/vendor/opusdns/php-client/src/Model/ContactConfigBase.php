<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainContactType;
use OpusDNS\Client\Serializer;

final readonly class ContactConfigBase implements ApiModel
{
    /**
     * @param int $max Maximum contacts per domain name
     * @param int $min Minimum contacts per domain name
     * @param DomainContactType|string $type The type of contact
     */
    public function __construct(
        public int $max,
        public int $min,
        public DomainContactType|string $type,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            max: $data['max'],
            min: $data['min'],
            type: DomainContactType::tryFrom($data['type']) ?? $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'max' => $this->max,
            'min' => $this->min,
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
