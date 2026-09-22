<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ConversationCreateRequest implements ApiModel
{
    /**
     * @param array<string, mixed>|null $metadata
     */
    public function __construct(
        public ?array $metadata = null,
        public ?string $title = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            metadata: isset($data['metadata']) ? (array) $data['metadata'] : null,
            title: $data['title'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'metadata' => $this->metadata === null ? null : ($this->metadata === [] ? new \stdClass() : $this->metadata),
            'title' => $this->title,
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
