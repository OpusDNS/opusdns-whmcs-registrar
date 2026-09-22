<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class MemoryFactListResponse implements ApiModel
{
    /**
     * @param list<MemoryFact> $results
     */
    public function __construct(
        public array $results,
        public ?string $nextCursor = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            results: array_map(static fn (array $item): MemoryFact => MemoryFact::fromArray($item), $data['results']),
            nextCursor: $data['next_cursor'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'results' => $this->results,
            'next_cursor' => $this->nextCursor,
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
