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
 * ContextPayload[RegistrarDomain]
 */
final class ContextPayloadRegistrarDomain implements ApiModel
{
    /**
     * @param list<RegistrarDomain> $results
     */
    public function __construct(
        public readonly array $results,
        public readonly ?ContextMeta $meta = null,
        public readonly ?PaginationMetadata $pagination = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            results: array_map(static fn (array $item): RegistrarDomain => RegistrarDomain::fromArray($item), $data['results']),
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
