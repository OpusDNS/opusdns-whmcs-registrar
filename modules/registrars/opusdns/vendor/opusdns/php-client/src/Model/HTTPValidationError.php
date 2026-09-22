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
 * RequestValidationError
 */
final readonly class HTTPValidationError implements ApiModel
{
    /**
     * @param list<ValidationError> $errors
     */
    public function __construct(
        public array $errors,
        public int $status,
        public string $title,
        public string $type,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            errors: array_map(static fn (array $item): ValidationError => ValidationError::fromArray($item), $data['errors']),
            status: $data['status'],
            title: $data['title'],
            type: $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'errors' => $this->errors,
            'status' => $this->status,
            'title' => $this->title,
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
