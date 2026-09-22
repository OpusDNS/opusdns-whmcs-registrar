<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\TagColor;
use OpusDNS\Client\Serializer;

final readonly class TagUpdate implements ApiModel
{
    /**
     * @param TagColor|string|null $color The color of the tag
     * @param string|null $description Optional description of the tag
     * @param string|null $label A human-readable label for the tag
     */
    public function __construct(
        public TagColor|string|null $color = null,
        public ?string $description = null,
        public ?string $label = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            color: isset($data['color']) ? TagColor::tryFrom($data['color']) ?? $data['color'] : null,
            description: $data['description'] ?? null,
            label: $data['label'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'color' => $this->color,
            'description' => $this->description,
            'label' => $this->label,
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
