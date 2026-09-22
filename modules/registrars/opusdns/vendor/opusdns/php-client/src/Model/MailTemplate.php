<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\MailTemplateCategory;
use OpusDNS\Client\Serializer;

/**
 * One editable transactional email template in the catalog.
 */
final readonly class MailTemplate implements ApiModel
{
    /**
     * @param array<string, MailTemplateBlock>|null $blocks Org-editable content blocks
     * @param MailTemplateCategory|string $category Template category for grouping in the editor
     * @param string $label Human-readable template name for display
     * @param list<string>|null $locales Supported locales, first is the fallback
     * @param array<string, string>|null $subject Subject line per locale
     * @param array<string, MailTemplateVariable>|null $variables Per-send variables
     * @param string $version Template revision (major.minor)
     */
    public function __construct(
        public ?array $blocks = null,
        public MailTemplateCategory|string $category = MailTemplateCategory::UNKNOWN,
        public string $label = '',
        public ?array $locales = null,
        public ?array $subject = null,
        public ?array $variables = null,
        public string $version = '',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            blocks: isset($data['blocks']) ? array_map(static fn (array $value): MailTemplateBlock => MailTemplateBlock::fromArray($value), (array) $data['blocks']) : null,
            category: isset($data['category']) ? MailTemplateCategory::tryFrom($data['category']) ?? $data['category'] : MailTemplateCategory::UNKNOWN,
            label: $data['label'] ?? '',
            locales: $data['locales'] ?? null,
            subject: isset($data['subject']) ? (array) $data['subject'] : null,
            variables: isset($data['variables']) ? array_map(static fn (array $value): MailTemplateVariable => MailTemplateVariable::fromArray($value), (array) $data['variables']) : null,
            version: $data['version'] ?? '',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'blocks' => $this->blocks === null ? null : ($this->blocks === [] ? new \stdClass() : $this->blocks),
            'category' => $this->category,
            'label' => $this->label,
            'locales' => $this->locales,
            'subject' => $this->subject === null ? null : ($this->subject === [] ? new \stdClass() : $this->subject),
            'variables' => $this->variables === null ? null : ($this->variables === [] ? new \stdClass() : $this->variables),
            'version' => $this->version,
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
