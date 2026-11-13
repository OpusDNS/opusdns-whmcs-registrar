<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class DomainForwardMoverResponse implements ApiModel
{
    /**
     * @param int $change `total_visits` minus `previous_total_visits`
     * @param string $domain The domain whose forwards served the redirects, without a trailing dot
     * @param string $organizationId The organization the redirects were counted for TypeID prefix: organization.
     * @param int $previousTotalVisits Number of redirects served in the period of the same length before it
     * @param int $totalVisits Number of redirects served in the period
     * @param float|null $changeRatio `change` relative to `previous_total_visits`; null when the previous period had
     *     no redirects
     */
    public function __construct(
        public readonly int $change,
        public readonly string $domain,
        public readonly string $organizationId,
        public readonly int $previousTotalVisits,
        public readonly int $totalVisits,
        public readonly ?float $changeRatio = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            change: $data['change'],
            domain: $data['domain'],
            organizationId: $data['organization_id'],
            previousTotalVisits: $data['previous_total_visits'],
            totalVisits: $data['total_visits'],
            changeRatio: $data['change_ratio'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'change' => $this->change,
            'domain' => $this->domain,
            'organization_id' => $this->organizationId,
            'previous_total_visits' => $this->previousTotalVisits,
            'total_visits' => $this->totalVisits,
            'change_ratio' => $this->changeRatio,
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
