<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class AggregationsContextPayload implements ApiModel
{
    /**
     * @param list<AggregationResult> $aggregations
     */
    public function __construct(
        public array $aggregations,
        public string $question,
        public ?int $total = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            aggregations: array_map(static fn (array $item): AggregationResult => AggregationResult::fromArray($item), $data['aggregations']),
            question: $data['question'],
            total: $data['total'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'aggregations' => $this->aggregations,
            'question' => $this->question,
            'total' => $this->total,
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
