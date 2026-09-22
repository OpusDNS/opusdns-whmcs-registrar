<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class AllowedNumberOfNameserverBase implements ApiModel
{
    /**
     * @param int $max Maximum number of nameserver per domain name
     * @param int $min Minimum number of nameserver per domain name
     */
    public function __construct(
        public int $max,
        public int $min,
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
