<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class AiInferenceUsageSummaryResponse implements ApiModel
{
    /**
     * @param list<AiInferenceUsageGroup> $groups
     */
    public function __construct(
        public \DateTimeImmutable $endDate,
        public array $groups,
        public \DateTimeImmutable $startDate,
        public string $product = 'ai_inference',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            endDate: Serializer::parseDate($data['end_date']),
            groups: array_map(static fn (array $item): AiInferenceUsageGroup => AiInferenceUsageGroup::fromArray($item), $data['groups']),
            startDate: Serializer::parseDate($data['start_date']),
            product: $data['product'] ?? 'ai_inference',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'end_date' => $this->endDate->format('Y-m-d'),
            'groups' => $this->groups,
            'start_date' => $this->startDate->format('Y-m-d'),
            'product' => $this->product,
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
