<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\AuditRuleId;
use OpusDNS\Client\Serializer;

final readonly class AuditRule implements ApiModel
{
    /**
     * @param AuditRuleId|string $id Stable rule id; never renamed. `title` and `explanation` are its English text.
     * @param list<string> $sample Up to five affected names, most severe first.
     * @param string $severity critical | warning | info
     */
    public function __construct(
        public AuditFix $fix,
        public AuditRuleId|string $id,
        public array $sample,
        public int $count = 0,
        public string $explanation = '',
        public string $severity = '',
        public string $title = '',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            fix: AuditFix::fromArray($data['fix']),
            id: AuditRuleId::tryFrom($data['id']) ?? $data['id'],
            sample: $data['sample'],
            count: $data['count'] ?? 0,
            explanation: $data['explanation'] ?? '',
            severity: $data['severity'] ?? '',
            title: $data['title'] ?? '',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'fix' => $this->fix,
            'id' => $this->id,
            'sample' => $this->sample,
            'count' => $this->count,
            'explanation' => $this->explanation,
            'severity' => $this->severity,
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
