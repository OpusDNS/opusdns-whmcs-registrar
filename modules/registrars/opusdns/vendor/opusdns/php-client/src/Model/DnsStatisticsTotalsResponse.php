<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsStatisticsTotalsResponse implements ApiModel
{
    /**
     * @param int|null $nxdomainCount Of those, queries answered with NXDOMAIN. Null when no bucket is covered
     * @param int|null $queryCount Queries answered for the organization's zones, summed over the covered buckets.
     *     Null when no bucket is covered
     */
    public function __construct(
        public ?int $nxdomainCount = null,
        public ?int $queryCount = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            nxdomainCount: $data['nxdomain_count'] ?? null,
            queryCount: $data['query_count'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'nxdomain_count' => $this->nxdomainCount,
            'query_count' => $this->queryCount,
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
