<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardMetricsFilters implements ApiModel
{
    /**
     * @param string $domain Domain name
     * @param string|null $endTime End time filter (RFC3339)
     * @param bool|null $includeAliases Whether alias breakdown is included
     * @param string|null $startTime Start time filter (RFC3339)
     */
    public function __construct(
        public string $domain,
        public ?string $endTime = null,
        public ?bool $includeAliases = null,
        public ?string $startTime = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            domain: $data['domain'],
            endTime: $data['end_time'] ?? null,
            includeAliases: $data['include_aliases'] ?? null,
            startTime: $data['start_time'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'domain' => $this->domain,
            'end_time' => $this->endTime,
            'include_aliases' => $this->includeAliases,
            'start_time' => $this->startTime,
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
