<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class Content implements ApiModel
{
    /**
     * @param array<string, mixed>|null $emailBlocks
     */
    public function __construct(
        public ?array $emailBlocks = null,
        public ?Footer $footer = null,
        public ?Legal $legal = null,
        public ?string $signature = null,
        public ?Support $support = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            emailBlocks: isset($data['email_blocks']) ? (array) $data['email_blocks'] : null,
            footer: isset($data['footer']) ? Footer::fromArray($data['footer']) : null,
            legal: isset($data['legal']) ? Legal::fromArray($data['legal']) : null,
            signature: $data['signature'] ?? null,
            support: isset($data['support']) ? Support::fromArray($data['support']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'email_blocks' => $this->emailBlocks === null ? null : ($this->emailBlocks === [] ? new \stdClass() : $this->emailBlocks),
            'footer' => $this->footer,
            'legal' => $this->legal,
            'signature' => $this->signature,
            'support' => $this->support,
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
