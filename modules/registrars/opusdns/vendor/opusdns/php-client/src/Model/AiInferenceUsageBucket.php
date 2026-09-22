<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class AiInferenceUsageBucket implements ApiModel
{
    /**
     * @param list<AiInferenceUsageGroup> $groups
     */
    public function __construct(
        public array $groups,
        public \DateTimeImmutable $periodStart,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            groups: array_map(static fn (array $item): AiInferenceUsageGroup => AiInferenceUsageGroup::fromArray($item), $data['groups']),
            periodStart: Serializer::parseDate($data['period_start']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'groups' => $this->groups,
            'period_start' => $this->periodStart->format('Y-m-d'),
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
