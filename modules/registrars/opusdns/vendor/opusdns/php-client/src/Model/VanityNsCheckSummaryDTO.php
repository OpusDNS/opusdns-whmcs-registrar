<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\VanityNsCheckSummaryState;
use OpusDNS\Client\Serializer;

final readonly class VanityNsCheckSummaryDTO implements ApiModel
{
    /**
     * @param string $detail Customer-facing summary of the overall verdict
     * @param VanityNsCheckSummaryState|string $state Overall verdict synthesized from the checks
     */
    public function __construct(
        public string $detail,
        public VanityNsCheckSummaryState|string $state,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            detail: $data['detail'],
            state: VanityNsCheckSummaryState::tryFrom($data['state']) ?? $data['state'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'detail' => $this->detail,
            'state' => $this->state,
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
