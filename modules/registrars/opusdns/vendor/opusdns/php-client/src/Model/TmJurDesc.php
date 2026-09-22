<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * Jurisdiction description (jurDescType in RFC 9361)
 */
final readonly class TmJurDesc implements ApiModel
{
    /**
     * @param string $description Name of jurisdiction in English
     * @param string $jurCc WIPO ST.3 two-character jurisdiction code
     */
    public function __construct(
        public string $description,
        public string $jurCc,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            description: $data['description'],
            jurCc: $data['jur_cc'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'description' => $this->description,
            'jur_cc' => $this->jurCc,
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
