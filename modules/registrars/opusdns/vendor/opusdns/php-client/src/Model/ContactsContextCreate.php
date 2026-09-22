<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactsContextCreate implements ApiModel
{
    public function __construct(
        public ContextPayloadRegistrarContact $payload,
        public string $kind = 'contacts',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            payload: ContextPayloadRegistrarContact::fromArray($data['payload']),
            kind: $data['kind'] ?? 'contacts',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'payload' => $this->payload,
            'kind' => $this->kind,
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
