<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\TagType;
use OpusDNS\Client\Serializer;

final readonly class BulkObjectTagChanges implements ApiModel
{
    /**
     * @param list<string> $objects Object references to operate on. TypeIDs and resource names may be mixed.
     * @param TagType|string $type The object/tag type (e.g. DOMAIN, CONTACT, ZONE)
     * @param list<string>|null $add Tag IDs to add to the objects.
     * @param list<string>|null $remove Tag IDs to remove from the objects.
     * @param list<string>|null $replace Tag IDs to set as the complete tag set for the objects, replacing any
     *     existing tags. Mutually exclusive with 'add' and 'remove'. An empty list removes all tags.
     */
    public function __construct(
        public array $objects,
        public TagType|string $type,
        public ?array $add = null,
        public ?array $remove = null,
        public ?array $replace = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            objects: $data['objects'],
            type: TagType::tryFrom($data['type']) ?? $data['type'],
            add: $data['add'] ?? null,
            remove: $data['remove'] ?? null,
            replace: $data['replace'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'objects' => $this->objects,
            'type' => $this->type,
            'add' => $this->add,
            'remove' => $this->remove,
            'replace' => $this->replace,
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
