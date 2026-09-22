<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\TagColor;
use OpusDNS\Client\Enum\TagType;
use OpusDNS\Client\Serializer;

final readonly class TagCreate implements ApiModel
{
    /**
     * @param string $label A human-readable label for the tag
     * @param TagType|string $type Which category a tag applies to, cannot be changed once created
     * @param TagColor|string|null $color The color of the tag
     * @param string|null $description Optional description of the tag
     */
    public function __construct(
        public string $label,
        public TagType|string $type,
        public TagColor|string|null $color = TagColor::COLOR_1,
        public ?string $description = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            label: $data['label'],
            type: TagType::tryFrom($data['type']) ?? $data['type'],
            color: isset($data['color']) ? TagColor::tryFrom($data['color']) ?? $data['color'] : TagColor::COLOR_1,
            description: $data['description'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'label' => $this->label,
            'type' => $this->type,
            'color' => $this->color,
            'description' => $this->description,
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
