<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\MessageRole;
use OpusDNS\Client\Serializer;

final readonly class MessageCreateRequest implements ApiModel
{
    /**
     * @param array<string, mixed>|null $metadata
     * @param int|null $n8nHistoryId Optional reference to the originating n8n_chat_histories row.
     */
    public function __construct(
        public string $content,
        public MessageRole|string $role,
        public ?array $metadata = null,
        public ?int $n8nHistoryId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            content: $data['content'],
            role: MessageRole::tryFrom($data['role']) ?? $data['role'],
            metadata: isset($data['metadata']) ? (array) $data['metadata'] : null,
            n8nHistoryId: $data['n8n_history_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'content' => $this->content,
            'role' => $this->role,
            'metadata' => $this->metadata === null ? null : ($this->metadata === [] ? new \stdClass() : $this->metadata),
            'n8n_history_id' => $this->n8nHistoryId,
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
