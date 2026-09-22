<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ListVanityNameserverSetsRes implements ApiModel
{
    /**
     * @param PaginationMetadataDTO $pagination Pagination metadata
     * @param list<VanityNameserverSetSummaryDTO>|null $results Sets owned by the org, newest first; includes
     *     non-ACTIVE rows
     */
    public function __construct(
        public PaginationMetadataDTO $pagination,
        public ?array $results = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            pagination: PaginationMetadataDTO::fromArray($data['pagination']),
            results: isset($data['results']) ? array_map(static fn (array $item): VanityNameserverSetSummaryDTO => VanityNameserverSetSummaryDTO::fromArray($item), $data['results']) : null,
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
}
