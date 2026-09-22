<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class PaginationMetadata implements ApiModel
{
    public function __construct(
        public int $currentPage,
        public bool $hasNextPage,
        public bool $hasPreviousPage,
        public int $pageSize,
        public int $totalItems,
        public int $totalPages,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            currentPage: $data['current_page'],
            hasNextPage: $data['has_next_page'],
            hasPreviousPage: $data['has_previous_page'],
            pageSize: $data['page_size'],
            totalItems: $data['total_items'],
            totalPages: $data['total_pages'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'current_page' => $this->currentPage,
            'has_next_page' => $this->hasNextPage,
            'has_previous_page' => $this->hasPreviousPage,
            'page_size' => $this->pageSize,
            'total_items' => $this->totalItems,
            'total_pages' => $this->totalPages,
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
