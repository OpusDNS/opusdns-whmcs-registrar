<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class AuditFindingsContext implements ApiModel
{
    /**
     * @param string $contextId TypeID prefix: ctx.
     * @param string $conversationId TypeID prefix: conv.
     * @param string $organizationId TypeID prefix: organization.
     */
    public function __construct(
        public readonly string $contextId,
        public readonly string $conversationId,
        public readonly \DateTimeImmutable $createdAt,
        public readonly string $organizationId,
        public readonly AuditFindingsContextPayload $payload,
        public readonly string $userId,
        public readonly string $kind = 'audit_findings',
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
            payload: AuditFindingsContextPayload::fromArray($data['payload']),
            userId: $data['user_id'],
            kind: $data['kind'] ?? 'audit_findings',
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
