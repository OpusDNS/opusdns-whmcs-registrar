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
final readonly class CommonModelsAvailabilityDatasourceDomainAvailabilityResponse implements ApiModel
{
    /**
     * @param list<DomainAvailability> $results
     */
    public function __construct(
        public DomainAvailabilityMeta $meta,
        public array $results,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            meta: DomainAvailabilityMeta::fromArray($data['meta']),
            results: array_map(static fn (array $item): DomainAvailability => DomainAvailability::fromArray($item), $data['results']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'meta' => $this->meta,
            'results' => $this->results,
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
