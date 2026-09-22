<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class MailTemplateVariable implements ApiModel
{
    /**
     * @param string $sample Sample value shown in previews
     * @param string $type Value type driving render-time escaping (text or url)
     */
    public function __construct(
        public bool $required = false,
        public string $sample = '',
        public string $type = 'text',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            required: $data['required'] ?? false,
            sample: $data['sample'] ?? '',
            type: $data['type'] ?? 'text',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'required' => $this->required,
            'sample' => $this->sample,
            'type' => $this->type,
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
