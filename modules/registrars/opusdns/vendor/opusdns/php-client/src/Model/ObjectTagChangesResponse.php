<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ObjectTagChangesResponse implements ApiModel
{
    /**
     * @param int $added Number of objects tagged
     * @param int $removed Number of objects untagged
     * @param list<string>|null $unresolved References that could not be resolved
     */
    public function __construct(
        public int $added,
        public int $removed,
        public ?array $unresolved = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            added: $data['added'],
            removed: $data['removed'],
            unresolved: $data['unresolved'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'added' => $this->added,
            'removed' => $this->removed,
            'unresolved' => $this->unresolved,
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
