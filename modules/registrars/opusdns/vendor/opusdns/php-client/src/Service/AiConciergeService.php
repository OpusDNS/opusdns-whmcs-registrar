<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Model\AggregationsContext;
use OpusDNS\Client\Model\AggregationsContextCreate;
use OpusDNS\Client\Model\ContactsContext;
use OpusDNS\Client\Model\ContactsContextCreate;
use OpusDNS\Client\Model\ContextListResponse;
use OpusDNS\Client\Model\Conversation;
use OpusDNS\Client\Model\ConversationCreateRequest;
use OpusDNS\Client\Model\ConversationListResponse;
use OpusDNS\Client\Model\ConversationPatchRequest;
use OpusDNS\Client\Model\DomainForwardsContext;
use OpusDNS\Client\Model\DomainForwardsContextCreate;
use OpusDNS\Client\Model\DomainRecommendationsContext;
use OpusDNS\Client\Model\DomainRecommendationsContextCreate;
use OpusDNS\Client\Model\DomainsContext;
use OpusDNS\Client\Model\DomainsContextCreate;
use OpusDNS\Client\Model\EmailForwardsContext;
use OpusDNS\Client\Model\EmailForwardsContextCreate;
use OpusDNS\Client\Model\MemoryFact;
use OpusDNS\Client\Model\MemoryFactCreateRequest;
use OpusDNS\Client\Model\MemoryFactListResponse;
use OpusDNS\Client\Model\MemoryFactPatchRequest;
use OpusDNS\Client\Model\Message;
use OpusDNS\Client\Model\MessageCreateRequest;
use OpusDNS\Client\Model\MessageListResponse;
use OpusDNS\Client\Model\ZonesContext;
use OpusDNS\Client\Model\ZonesContextCreate;
use OpusDNS\Client\Union;

/**
 * Operations tagged "ai_concierge".
 */
final class AiConciergeService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Get a context entry
     *
     * Required permissions: ai_concierge:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     * @return ZonesContext|ContactsContext|DomainsContext|DomainForwardsContext|EmailForwardsContext|DomainRecommendationsContext|AggregationsContext
     */
    public function getContext(
        string $contextId,
        ?string $xDatetimeFormat = null,
    ): ZonesContext|ContactsContext|DomainsContext|DomainForwardsContext|EmailForwardsContext|DomainRecommendationsContext|AggregationsContext {
        $response = $this->client->request(
            'GET',
            Endpoint::AI_CONCIERGE_CONTEXTS_BY_CONTEXT_ID,
            path: ['context_id' => $contextId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ZonesContext|ContactsContext|DomainsContext|DomainForwardsContext|EmailForwardsContext|DomainRecommendationsContext|AggregationsContext => Union::discriminate($data, 'kind', [
            'aggregations' => AggregationsContext::class,
            'contacts' => ContactsContext::class,
            'domain_forwards' => DomainForwardsContext::class,
            'domain_recommendations' => DomainRecommendationsContext::class,
            'domains' => DomainsContext::class,
            'email_forwards' => EmailForwardsContext::class,
            'zones' => ZonesContext::class,
        ]));
    }

    /**
     * List AI Concierge conversations
     *
     * List the authenticated organization's AI Concierge conversations.
     *
     * Required permissions: ai_concierge:manage
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 20.
     * @param string|null $sort Comma-separated sort fields. Prefix with `-` for DESC.
     * @param string|null $query Full-text search on title/summary.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listConversations(
        ?int $page = null,
        ?int $pageSize = null,
        ?string $sort = null,
        ?string $query = null,
        ?string $xDatetimeFormat = null,
    ): ConversationListResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::AI_CONCIERGE_CONVERSATIONS,
            query: ['page' => $page, 'page_size' => $pageSize, 'sort' => $sort, 'q' => $query],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ConversationListResponse => ConversationListResponse::fromArray($data));
    }

    /**
     * Create an AI Concierge conversation
     *
     * Required permissions: ai_concierge:manage
     *
     * @param ConversationCreateRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createConversation(
        ConversationCreateRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): Conversation {
        $response = $this->client->request(
            'POST',
            Endpoint::AI_CONCIERGE_CONVERSATIONS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): Conversation => Conversation::fromArray($data));
    }

    /**
     * Get a conversation
     *
     * Required permissions: ai_concierge:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getConversation(string $conversationId, ?string $xDatetimeFormat = null): Conversation
    {
        $response = $this->client->request(
            'GET',
            Endpoint::AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID,
            path: ['conversation_id' => $conversationId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): Conversation => Conversation::fromArray($data));
    }

    /**
     * Update a conversation
     *
     * Update conversation title or metadata. Supports optimistic concurrency via `If-Match`.
     *
     * Required permissions: ai_concierge:manage
     *
     * @param ConversationPatchRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function patchConversation(
        string $conversationId,
        ConversationPatchRequest|array $body,
        ?string $ifMatch = null,
        ?string $xDatetimeFormat = null,
    ): Conversation {
        $response = $this->client->request(
            'PATCH',
            Endpoint::AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID,
            path: ['conversation_id' => $conversationId],
            body: $body,
            headers: ['If-Match' => $ifMatch, 'X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): Conversation => Conversation::fromArray($data));
    }

    /**
     * Delete a conversation
     *
     * Permanently delete a conversation, its messages, and any attached contexts.
     *
     * Required permissions: ai_concierge:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteConversation(string $conversationId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID,
            path: ['conversation_id' => $conversationId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * List contexts attached to a conversation
     *
     * Required permissions: ai_concierge:manage
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 20.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listContexts(
        string $conversationId,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): ContextListResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID_CONTEXTS,
            path: ['conversation_id' => $conversationId],
            query: ['page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ContextListResponse => ContextListResponse::fromArray($data));
    }

    /**
     * Attach a context to a conversation
     *
     * Required permissions: ai_concierge:manage
     *
     * @param ZonesContextCreate|ContactsContextCreate|DomainsContextCreate|DomainForwardsContextCreate|EmailForwardsContextCreate|DomainRecommendationsContextCreate|AggregationsContextCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     * @return ZonesContext|ContactsContext|DomainsContext|DomainForwardsContext|EmailForwardsContext|DomainRecommendationsContext|AggregationsContext
     */
    public function createContext(
        string $conversationId,
        ZonesContextCreate|ContactsContextCreate|DomainsContextCreate|DomainForwardsContextCreate|EmailForwardsContextCreate|DomainRecommendationsContextCreate|AggregationsContextCreate|array $body,
        ?string $xDatetimeFormat = null,
    ): ZonesContext|ContactsContext|DomainsContext|DomainForwardsContext|EmailForwardsContext|DomainRecommendationsContext|AggregationsContext {
        $response = $this->client->request(
            'POST',
            Endpoint::AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID_CONTEXTS,
            path: ['conversation_id' => $conversationId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ZonesContext|ContactsContext|DomainsContext|DomainForwardsContext|EmailForwardsContext|DomainRecommendationsContext|AggregationsContext => Union::discriminate($data, 'kind', [
            'aggregations' => AggregationsContext::class,
            'contacts' => ContactsContext::class,
            'domain_forwards' => DomainForwardsContext::class,
            'domain_recommendations' => DomainRecommendationsContext::class,
            'domains' => DomainsContext::class,
            'email_forwards' => EmailForwardsContext::class,
            'zones' => ZonesContext::class,
        ]));
    }

    /**
     * List messages in a conversation
     *
     * Required permissions: ai_concierge:manage
     *
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 20.
     * @param int|null $recent If set, returns last N messages and overrides pagination.
     * @param string|null $exclude Comma-separated tokens to exclude (case-insensitive). Supports `tools`.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listMessages(
        string $conversationId,
        ?int $page = null,
        ?int $pageSize = null,
        ?int $recent = null,
        ?string $exclude = null,
        ?string $xDatetimeFormat = null,
    ): MessageListResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID_MESSAGES,
            path: ['conversation_id' => $conversationId],
            query: ['page' => $page, 'page_size' => $pageSize, 'recent' => $recent, 'exclude' => $exclude],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): MessageListResponse => MessageListResponse::fromArray($data));
    }

    /**
     * Append a message to a conversation
     *
     * Required permissions: ai_concierge:manage
     *
     * @param MessageCreateRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createMessage(
        string $conversationId,
        MessageCreateRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): Message {
        $response = $this->client->request(
            'POST',
            Endpoint::AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID_MESSAGES,
            path: ['conversation_id' => $conversationId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): Message => Message::fromArray($data));
    }

    /**
     * Get a message
     *
     * Required permissions: ai_concierge:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getMessage(string $conversationId, string $messageId, ?string $xDatetimeFormat = null): Message
    {
        $response = $this->client->request(
            'GET',
            Endpoint::AI_CONCIERGE_CONVERSATIONS_BY_CONVERSATION_ID_MESSAGES_BY_MESSAGE_ID,
            path: ['conversation_id' => $conversationId, 'message_id' => $messageId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): Message => Message::fromArray($data));
    }

    /**
     * List long-term memory facts
     *
     * List long-term, organization-scoped memory facts available to the AI Concierge.
     *
     * Required permissions: ai_concierge:manage
     *
     * @param int|null $limit Server default: 50.
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listMemoryFacts(
        ?int $limit = null,
        ?string $cursor = null,
        ?string $kind = null,
        ?string $xDatetimeFormat = null,
    ): MemoryFactListResponse {
        $response = $this->client->request(
            'GET',
            Endpoint::AI_CONCIERGE_MEMORY_FACTS,
            query: ['limit' => $limit, 'cursor' => $cursor, 'kind' => $kind],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): MemoryFactListResponse => MemoryFactListResponse::fromArray($data));
    }

    /**
     * Create a long-term memory fact
     *
     * Required permissions: ai_concierge:manage
     *
     * @param MemoryFactCreateRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createMemoryFact(MemoryFactCreateRequest|array $body, ?string $xDatetimeFormat = null): MemoryFact
    {
        $response = $this->client->request(
            'POST',
            Endpoint::AI_CONCIERGE_MEMORY_FACTS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): MemoryFact => MemoryFact::fromArray($data));
    }

    /**
     * Update a long-term memory fact
     *
     * Required permissions: ai_concierge:manage
     *
     * @param MemoryFactPatchRequest|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function patchMemoryFact(
        string $factId,
        MemoryFactPatchRequest|array $body,
        ?string $xDatetimeFormat = null,
    ): MemoryFact {
        $response = $this->client->request(
            'PATCH',
            Endpoint::AI_CONCIERGE_MEMORY_FACTS_BY_FACT_ID,
            path: ['fact_id' => $factId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): MemoryFact => MemoryFact::fromArray($data));
    }

    /**
     * Delete a long-term memory fact
     *
     * Required permissions: ai_concierge:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteMemoryFact(string $factId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::AI_CONCIERGE_MEMORY_FACTS_BY_FACT_ID,
            path: ['fact_id' => $factId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }
}
