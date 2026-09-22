<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainRecommendationsContextCreate implements ApiModel
{
    public function __construct(
        public ContextPayloadDomainSearchSuggestionWithPrice $payload,
        public string $kind = 'domain_recommendations',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            payload: ContextPayloadDomainSearchSuggestionWithPrice::fromArray($data['payload']),
            kind: $data['kind'] ?? 'domain_recommendations',
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
