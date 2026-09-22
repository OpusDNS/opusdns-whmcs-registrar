<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ReservedSourceType;
use OpusDNS\Client\Serializer;

final readonly class ReservedDomainsBase implements ApiModel
{
    /**
     * @param bool $supported Registry provides a reserved list
     * @param ReservedSourceType|string|null $source Source of reserved domain information
     * @param string|null $url Link to reserved list
     */
    public function __construct(
        public bool $supported,
        public ReservedSourceType|string|null $source = null,
        public ?string $url = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            supported: $data['supported'],
            source: isset($data['source']) ? ReservedSourceType::tryFrom($data['source']) ?? $data['source'] : null,
            url: $data['url'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'supported' => $this->supported,
            'source' => $this->source,
            'url' => $this->url,
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
