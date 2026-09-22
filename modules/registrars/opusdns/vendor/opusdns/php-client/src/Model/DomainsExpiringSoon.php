<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainsExpiringSoon implements ApiModel
{
    /**
     * @param int $next30Days Number of domains expiring in the next 30 days
     * @param int $next60Days Number of domains expiring in the next 60 days
     * @param int $next90Days Number of domains expiring in the next 90 days
     */
    public function __construct(
        public int $next30Days,
        public int $next60Days,
        public int $next90Days,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            next30Days: $data['next_30_days'],
            next60Days: $data['next_60_days'],
            next90Days: $data['next_90_days'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'next_30_days' => $this->next30Days,
            'next_60_days' => $this->next60Days,
            'next_90_days' => $this->next90Days,
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
