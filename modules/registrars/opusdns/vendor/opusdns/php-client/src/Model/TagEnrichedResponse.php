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

final readonly class TagEnrichedResponse implements ApiModel
{
    /**
     * @param TagColor|string $color The color of the tag
     * @param string $label The label of the tag
     * @param string $tagId The unique identifier of the tag TypeID prefix: tag.
     */
    public function __construct(
        public TagColor|string $color,
        public string $label,
        public string $tagId,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            color: TagColor::tryFrom($data['color']) ?? $data['color'],
            label: $data['label'],
            tagId: $data['tag_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'color' => $this->color,
            'label' => $this->label,
            'tag_id' => $this->tagId,
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
