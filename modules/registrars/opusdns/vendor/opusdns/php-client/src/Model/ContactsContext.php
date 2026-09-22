<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactsContext implements ApiModel
{
    /**
     * @param string $contextId TypeID prefix: ctx.
     * @param string $conversationId TypeID prefix: conv.
     * @param string $organizationId TypeID prefix: organization.
     */
    public function __construct(
        public string $contextId,
        public string $conversationId,
        public \DateTimeImmutable $createdAt,
        public string $organizationId,
        public ContextPayloadRegistrarContact $payload,
        public string $userId,
        public string $kind = 'contacts',
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
            payload: ContextPayloadRegistrarContact::fromArray($data['payload']),
            userId: $data['user_id'],
            kind: $data['kind'] ?? 'contacts',
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
