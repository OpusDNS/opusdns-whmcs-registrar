<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainRestoreRequest implements ApiModel
{
    /**
     * @param string|null $additionalInfo Additional information to include in the restore operation
     * @param string|null $expectedPrice Expected price for premium domain confirmation
     * @param string|null $reason Reason for restoring the domain
     */
    public function __construct(
        public ?string $additionalInfo = null,
        public ?string $expectedPrice = null,
        public ?string $reason = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            additionalInfo: $data['additional_info'] ?? null,
            expectedPrice: $data['expected_price'] ?? null,
            reason: $data['reason'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'additional_info' => $this->additionalInfo,
            'expected_price' => $this->expectedPrice,
            'reason' => $this->reason,
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
