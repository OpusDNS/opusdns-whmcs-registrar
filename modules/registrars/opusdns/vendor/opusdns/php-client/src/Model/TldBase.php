<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\TLDType;
use OpusDNS\Client\Serializer;

final readonly class TldBase implements ApiModel
{
    /**
     * @param string $name The TLD being configured
     * @param TLDType|string $type The type of the TLD (e.g., gTLD, ccTLD)
     * @param list<string> $thirdLevelStructure Name of the third levels (name and overrides)
     */
    public function __construct(
        public string $name,
        public TLDType|string $type,
        public array $thirdLevelStructure = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            type: TLDType::tryFrom($data['type']) ?? $data['type'],
            thirdLevelStructure: $data['third_level_structure'] ?? [],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'type' => $this->type,
            'third_level_structure' => $this->thirdLevelStructure,
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
