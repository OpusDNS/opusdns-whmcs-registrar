<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\VerificationClaimType;
use OpusDNS\Client\Serializer;

final readonly class VerificationResponse implements ApiModel
{
    /**
     * @param list<VerificationClaimType|string> $claims Verification claims
     * @param list<VerificationDeadline>|null $deadlines Verification deadlines
     */
    public function __construct(
        public array $claims,
        public ?array $deadlines = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            claims: array_map(static fn (string $item): VerificationClaimType|string => VerificationClaimType::tryFrom($item) ?? $item, $data['claims']),
            deadlines: isset($data['deadlines']) ? array_map(static fn (array $item): VerificationDeadline => VerificationDeadline::fromArray($item), $data['deadlines']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'claims' => $this->claims,
            'deadlines' => $this->deadlines,
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
