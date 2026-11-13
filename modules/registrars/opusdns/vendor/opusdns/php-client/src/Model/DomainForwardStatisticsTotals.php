<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class DomainForwardStatisticsTotals implements ApiModel
{
    /**
     * @param int $configuredForwards Number of redirect rules currently configured for the filtered scope (your
     *     organization, and its sub-organizations with `include_sub_organizations`). The current state, not the
     *     state during the window: it does not depend on the window, and it leaves out forwards deleted since, whose
     *     traffic still counts in the totals
     * @param int|null $invokedForwards Estimated number of distinct forwards (`rule_source_forward`: the forward's
     *     hostname, `*.example.com` for a wildcard) that served at least one redirect, counted with a HyperLogLog
     *     sketch. The `/metrics` route counts distinct domain and path pairs instead, so the two figures are not
     *     comparable, and `configured_forwards` counts redirect rules, so it is no ceiling for this figure: forwards
     *     that were deleted or moved to another organization during the window count here too. Null when the window
     *     has no data: no data, rather than no redirects
     * @param int|null $totalVisits Number of redirects served in the window. Null when the window has no data: no
     *     data, rather than no redirects
     * @param int|null $uniqueVisits Estimated number of distinct visitors (distinct client IP addresses, stored only
     *     as a keyed hash), counted with a HyperLogLog sketch and merged over the whole window rather than summed
     *     over buckets, so the figures of buckets do not add up to the total. Null when the window has no data: no
     *     data, rather than no redirects
     */
    public function __construct(
        public readonly int $configuredForwards,
        public readonly ?int $invokedForwards = null,
        public readonly ?int $totalVisits = null,
        public readonly ?int $uniqueVisits = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            configuredForwards: $data['configured_forwards'],
            invokedForwards: $data['invoked_forwards'] ?? null,
            totalVisits: $data['total_visits'] ?? null,
            uniqueVisits: $data['unique_visits'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'configured_forwards' => $this->configuredForwards,
            'invoked_forwards' => $this->invokedForwards,
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
