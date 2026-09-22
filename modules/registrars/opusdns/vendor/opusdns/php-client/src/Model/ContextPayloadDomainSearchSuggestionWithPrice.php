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
 * ContextPayload[DomainSearchSuggestionWithPrice]
 */
final readonly class ContextPayloadDomainSearchSuggestionWithPrice implements ApiModel
{
    /**
     * @param list<DomainSearchSuggestionWithPrice> $results
     */
    public function __construct(
        public array $results,
        public ?ContextMeta $meta = null,
        public ?PaginationMetadata $pagination = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            results: array_map(static fn (array $item): DomainSearchSuggestionWithPrice => DomainSearchSuggestionWithPrice::fromArray($item), $data['results']),
            meta: isset($data['meta']) ? ContextMeta::fromArray($data['meta']) : null,
            pagination: isset($data['pagination']) ? PaginationMetadata::fromArray($data['pagination']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'results' => $this->results,
            'meta' => $this->meta,
            'pagination' => $this->pagination,
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
