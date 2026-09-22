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

final readonly class Message implements ApiModel
{
    /**
     * @param string $conversationId TypeID prefix: conv.
     * @param string $messageId TypeID prefix: msg.
     * @param array<string, mixed>|null $metadata
     */
    public function __construct(
        public string $content,
        public string $conversationId,
        public \DateTimeImmutable $createdAt,
        public string $messageId,
        public MessageRole|string $role,
        public ?array $metadata = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            content: $data['content'],
            conversationId: $data['conversation_id'],
            createdAt: new \DateTimeImmutable($data['created_at']),
            messageId: $data['message_id'],
            role: MessageRole::tryFrom($data['role']) ?? $data['role'],
            metadata: isset($data['metadata']) ? (array) $data['metadata'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'content' => $this->content,
            'conversation_id' => $this->conversationId,
            'created_at' => $this->createdAt,
            'message_id' => $this->messageId,
            'role' => $this->role,
            'metadata' => $this->metadata === null ? null : ($this->metadata === [] ? new \stdClass() : $this->metadata),
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
