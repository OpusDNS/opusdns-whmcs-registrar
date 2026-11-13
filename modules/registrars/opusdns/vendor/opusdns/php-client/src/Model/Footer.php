<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class Footer implements ApiModel
{
    /**
     * @param list<string>|null $lines
     */
    public function __construct(
        public readonly ?string $legalEntity = null,
        public readonly ?array $lines = null,
        public readonly ?string $vatId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            legalEntity: $data['legal_entity'] ?? null,
            lines: $data['lines'] ?? null,
            vatId: $data['vat_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'legal_entity' => $this->legalEntity,
            'lines' => $this->lines,
            'vat_id' => $this->vatId,
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
