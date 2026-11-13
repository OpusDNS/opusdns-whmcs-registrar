<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class DomainForwardStatisticsBreakdownRow implements ApiModel
{
    /**
     * @param string $key The group: for `country` an ISO 3166-1 alpha-2 code, with an empty string for unknown; for
     *     `status_code` the configured redirect code as a string, e.g. `301`; for `referrer`, `direct` where the
     *     request had no referrer; for `url` host and path without query string, e.g. `www.example.com/shop`
     * @param int $totalVisits Number of redirects of this group
     * @param int $uniqueVisits Estimated number of distinct visitors (distinct client IP addresses, stored only as a
     *     keyed hash), counted with a HyperLogLog sketch and merged over the whole window rather than summed over
     *     buckets, so the figures of buckets do not add up to the total
     */
    public function __construct(
        public readonly string $key,
        public readonly int $totalVisits,
        public readonly int $uniqueVisits,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            key: $data['key'],
            totalVisits: $data['total_visits'],
            uniqueVisits: $data['unique_visits'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'key' => $this->key,
            'total_visits' => $this->totalVisits,
            'unique_visits' => $this->uniqueVisits,
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
