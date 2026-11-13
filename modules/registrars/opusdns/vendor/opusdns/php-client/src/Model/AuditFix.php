<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class AuditFix implements ApiModel
{
    /**
     * @param string|null $fixContextId A `domains` context of the OpusDNS-managed domains the rule found: the
     *     targets of `template`.
     * @param int|null $fixableCount How many domains `fix_context_id` holds.
     * @param string|null $reason Why a rule with a `template` has no `fix_context_id`, in English.
     * @param array<string, mixed>|null $template The shared change of a bulk domain update, for the bulk-fixable
     *     rules.
     * @param string|null $tool The concierge tool that can apply the fix.
     */
    public function __construct(
        public readonly ?string $fixContextId = null,
        public readonly ?int $fixableCount = null,
        public readonly string $hint = '',
        public readonly ?string $reason = null,
        public readonly ?array $template = null,
        public readonly ?string $tool = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            fixContextId: $data['fix_context_id'] ?? null,
            fixableCount: $data['fixable_count'] ?? null,
            hint: $data['hint'] ?? '',
            reason: $data['reason'] ?? null,
            template: isset($data['template']) ? (array) $data['template'] : null,
            tool: $data['tool'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'fix_context_id' => $this->fixContextId,
            'fixable_count' => $this->fixableCount,
            'hint' => $this->hint,
            'reason' => $this->reason,
            'template' => $this->template === null ? null : ($this->template === [] ? new \stdClass() : $this->template),
            'tool' => $this->tool,
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
