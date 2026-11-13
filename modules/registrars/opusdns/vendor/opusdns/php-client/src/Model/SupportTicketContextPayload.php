<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class SupportTicketContextPayload implements ApiModel
{
    /**
     * @param list<string> $checks What was checked, one line each, as listed in `content`.
     * @param string $category transfer | api_error | job | dns | billing | account | question | other
     * @param string $content The ticket text for the support form's content field: the summary in the user's
     *     language, then what was checked, the references and the conversation, labelled in English.
     * @param string $outcome needs_support (the cause needs the support team) | unresolved (the checks found no
     *     cause) | user_requested (the user asked for a person)
     * @param string $replaces The context id of the draft this one supersedes in the same conversation; empty for
     *     the first. Offer only the newest draft.
     * @param string $schema support_ticket/v1. Any other version arrives with every other field at its empty
     *     default: compare this with the version before offering to send the draft.
     * @param string $subject One line; the support form's subject.
     * @param string $summary The summary alone, as `content` opens with it.
     */
    public function __construct(
        public readonly array $checks,
        public readonly SupportTicketReferences $references,
        public readonly string $category = '',
        public readonly string $content = '',
        public readonly string $outcome = '',
        public readonly string $replaces = '',
        public readonly string $schema = '',
        public readonly string $subject = '',
        public readonly string $summary = '',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            checks: $data['checks'],
            references: SupportTicketReferences::fromArray($data['references']),
            category: $data['category'] ?? '',
            content: $data['content'] ?? '',
            outcome: $data['outcome'] ?? '',
            replaces: $data['replaces'] ?? '',
            schema: $data['schema'] ?? '',
            subject: $data['subject'] ?? '',
            summary: $data['summary'] ?? '',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'checks' => $this->checks,
            'references' => $this->references,
            'category' => $this->category,
            'content' => $this->content,
            'outcome' => $this->outcome,
            'replaces' => $this->replaces,
            'schema' => $this->schema,
            'subject' => $this->subject,
            'summary' => $this->summary,
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
