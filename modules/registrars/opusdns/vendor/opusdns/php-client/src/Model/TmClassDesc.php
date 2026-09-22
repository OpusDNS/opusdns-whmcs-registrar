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
 * Nice Classification description (classDescType in RFC 9361)
 */
final readonly class TmClassDesc implements ApiModel
{
    /**
     * @param int $classNum Nice Classification class number
     * @param string $description Description of the class in English
     */
    public function __construct(
        public int $classNum,
        public string $description,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            classNum: $data['class_num'],
            description: $data['description'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'class_num' => $this->classNum,
            'description' => $this->description,
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
