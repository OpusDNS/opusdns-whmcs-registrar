<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Page;
use OpusDNS\Client\Serializer;

/**
 * Pagination[Organization]
 *
 * @implements Page<Organization>
 */
final readonly class PaginationOrganization implements ApiModel, Page
{
    /**
     * @param list<Organization> $results
     */
    public function __construct(
        public PaginationMetadata $pagination,
        public array $results,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            pagination: PaginationMetadata::fromArray($data['pagination']),
            results: array_map(static fn (array $item): Organization => Organization::fromArray($item), $data['results']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'pagination' => $this->pagination,
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

    /**
     * @return list<Organization>
     */
    public function results(): array
    {
        return $this->results;
    }

    public function pagination(): PaginationMetadata
    {
        return $this->pagination;
    }
}
