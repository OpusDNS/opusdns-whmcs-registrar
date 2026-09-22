<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnsProtectedReason;
use OpusDNS\Client\Serializer;

final readonly class DnsRecordResponse implements ApiModel
{
    /**
     * @param bool $protected Whether the record is protected
     * @param DnsProtectedReason|string|null $protectedReason Reason why the record is protected
     */
    public function __construct(
        public string $rdata,
        public bool $protected = false,
        public DnsProtectedReason|string|null $protectedReason = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            rdata: $data['rdata'],
            protected: $data['protected'] ?? false,
            protectedReason: isset($data['protected_reason']) ? DnsProtectedReason::tryFrom($data['protected_reason']) ?? $data['protected_reason'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'rdata' => $this->rdata,
            'protected' => $this->protected,
            'protected_reason' => $this->protectedReason,
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
