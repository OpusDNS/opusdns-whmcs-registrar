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

final readonly class TagResponse implements ApiModel
{
    /**
     * @param TagColor|string $color The color of the tag
     * @param \DateTimeImmutable $createdOn The date/time the tag was created on
     * @param string $label The label of the tag
     * @param string $tagId The unique identifier of the tag TypeID prefix: tag.
     * @param TagType|string $type Which category a tag applies to, cannot be changed once created
     * @param \DateTimeImmutable $updatedOn The date/time the tag was last updated on
     * @param string|null $description Optional description of the tag
     * @param int $objectCount Number of objects tagged with this tag
     */
    public function __construct(
        public TagColor|string $color,
        public \DateTimeImmutable $createdOn,
        public string $label,
        public string $tagId,
        public TagType|string $type,
        public \DateTimeImmutable $updatedOn,
        public ?string $description = null,
        public int $objectCount = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            color: TagColor::tryFrom($data['color']) ?? $data['color'],
            createdOn: new \DateTimeImmutable($data['created_on']),
            label: $data['label'],
            tagId: $data['tag_id'],
            type: TagType::tryFrom($data['type']) ?? $data['type'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            description: $data['description'] ?? null,
            objectCount: $data['object_count'] ?? 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'color' => $this->color,
            'created_on' => $this->createdOn,
            'label' => $this->label,
            'tag_id' => $this->tagId,
            'type' => $this->type,
            'updated_on' => $this->updatedOn,
            'description' => $this->description,
            'object_count' => $this->objectCount,
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
