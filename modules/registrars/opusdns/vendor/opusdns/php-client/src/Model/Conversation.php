<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class Conversation implements ApiModel
{
    /**
     * @param string $conversationId TypeID prefix: conv.
     * @param string $organizationId TypeID prefix: organization.
     * @param array<string, mixed>|null $metadata
     * @param string|null $summary Optional rolling summary maintained by the memory service.
     * @param string|null $title Human-readable conversation title.
     */
    public function __construct(
        public readonly string $conversationId,
        public readonly \DateTimeImmutable $createdAt,
        public readonly string $organizationId,
        public readonly \DateTimeImmutable $updatedAt,
        public readonly string $userId,
        public readonly ?\DateTimeImmutable $lastMessageAt = null,
        public readonly int $messageCount = 0,
        public readonly ?array $metadata = null,
        public readonly ?string $summary = null,
        public readonly ?string $title = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            conversationId: $data['conversation_id'],
            createdAt: new \DateTimeImmutable($data['created_at']),
            organizationId: $data['organization_id'],
            updatedAt: new \DateTimeImmutable($data['updated_at']),
            userId: $data['user_id'],
            lastMessageAt: isset($data['last_message_at']) ? new \DateTimeImmutable($data['last_message_at']) : null,
            messageCount: $data['message_count'] ?? 0,
            metadata: isset($data['metadata']) ? (array) $data['metadata'] : null,
            summary: $data['summary'] ?? null,
            title: $data['title'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'conversation_id' => $this->conversationId,
            'created_at' => $this->createdAt,
            'organization_id' => $this->organizationId,
            'updated_at' => $this->updatedAt,
            'user_id' => $this->userId,
            'last_message_at' => $this->lastMessageAt,
            'message_count' => $this->messageCount,
            'metadata' => $this->metadata === null ? null : ($this->metadata === [] ? new \stdClass() : $this->metadata),
            'summary' => $this->summary,
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
