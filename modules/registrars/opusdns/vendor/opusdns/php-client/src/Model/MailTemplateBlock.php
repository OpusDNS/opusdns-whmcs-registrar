<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class MailTemplateBlock implements ApiModel
{
    /**
     * @param array<string, string>|null $default Default copy per locale
     * @param string $label Human-readable field name for the editor
     * @param int $maxLen Maximum override text length
     * @param bool $multiline Render the editor field as a textarea
     */
    public function __construct(
        public ?array $default = null,
        public string $label = '',
        public int $maxLen = 0,
        public bool $multiline = false,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            default: isset($data['default']) ? (array) $data['default'] : null,
            label: $data['label'] ?? '',
            maxLen: $data['max_len'] ?? 0,
            multiline: $data['multiline'] ?? false,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'default' => $this->default === null ? null : ($this->default === [] ? new \stdClass() : $this->default),
            'label' => $this->label,
            'max_len' => $this->maxLen,
            'multiline' => $this->multiline,
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
