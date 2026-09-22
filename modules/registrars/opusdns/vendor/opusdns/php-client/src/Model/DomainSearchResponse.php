<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainSearchResponse implements ApiModel
{
    /**
     * @param list<DomainSearchSuggestionWithPrice> $results
     */
    public function __construct(
        public DomainSearchMeta $meta,
        public array $results,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            meta: DomainSearchMeta::fromArray($data['meta']),
            results: array_map(static fn (array $item): DomainSearchSuggestionWithPrice => DomainSearchSuggestionWithPrice::fromArray($item), $data['results']),
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
