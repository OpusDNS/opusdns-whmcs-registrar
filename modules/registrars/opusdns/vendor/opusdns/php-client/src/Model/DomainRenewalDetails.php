<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainRenewalDetails implements ApiModel
{
    public function __construct(
        public \DateTimeImmutable $expiresOn,
        public string $detailType = 'domain_renewal',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            expiresOn: new \DateTimeImmutable($data['expires_on']),
            detailType: $data['detail_type'] ?? 'domain_renewal',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'expires_on' => $this->expiresOn,
            'detail_type' => $this->detailType,
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
