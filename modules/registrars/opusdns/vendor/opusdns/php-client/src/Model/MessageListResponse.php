<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class MessageListResponse implements ApiModel
{
    /**
     * @param list<Message> $results
     * @param PaginationMetadata|null $pagination Omitted when the `recent` query parameter is used.
     */
    public function __construct(
        public array $results,
        public ?PaginationMetadata $pagination = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            results: array_map(static fn (array $item): Message => Message::fromArray($item), $data['results']),
            pagination: isset($data['pagination']) ? PaginationMetadata::fromArray($data['pagination']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'results' => $this->results,
            'pagination' => $this->pagination,
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
