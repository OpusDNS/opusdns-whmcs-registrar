<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ObjectTagChanges implements ApiModel
{
    /**
     * @param list<string>|null $add Object TypeIDs or resource names to tag. TypeIDs and names may be mixed.
     * @param list<string>|null $remove Object TypeIDs or resource names to untag. TypeIDs and names may be mixed.
     */
    public function __construct(
        public ?array $add = null,
        public ?array $remove = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            add: $data['add'] ?? null,
            remove: $data['remove'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'add' => $this->add,
            'remove' => $this->remove,
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
