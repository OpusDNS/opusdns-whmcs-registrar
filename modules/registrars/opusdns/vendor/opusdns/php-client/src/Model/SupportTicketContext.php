<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class SupportTicketContext implements ApiModel
{
    /**
     * @param string $contextId TypeID prefix: ctx.
     * @param string $conversationId TypeID prefix: conv.
     * @param string $organizationId TypeID prefix: organization.
     * @param \DateTimeImmutable|null $sentAt When the user sent this draft to support (POST
     *     /v1/ai-concierge/support-tickets); null until then.
     */
    public function __construct(
        public readonly string $contextId,
        public readonly string $conversationId,
        public readonly \DateTimeImmutable $createdAt,
        public readonly string $organizationId,
        public readonly SupportTicketContextPayload $payload,
        public readonly string $userId,
        public readonly string $kind = 'support_ticket',
        public readonly ?\DateTimeImmutable $sentAt = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            contextId: $data['context_id'],
            conversationId: $data['conversation_id'],
            createdAt: new \DateTimeImmutable($data['created_at']),
            organizationId: $data['organization_id'],
            payload: SupportTicketContextPayload::fromArray($data['payload']),
            userId: $data['user_id'],
            kind: $data['kind'] ?? 'support_ticket',
            sentAt: isset($data['sent_at']) ? new \DateTimeImmutable($data['sent_at']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'context_id' => $this->contextId,
            'conversation_id' => $this->conversationId,
            'created_at' => $this->createdAt,
            'organization_id' => $this->organizationId,
            'payload' => $this->payload,
            'user_id' => $this->userId,
            'kind' => $this->kind,
            'sent_at' => $this->sentAt,
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
