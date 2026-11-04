<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ZoneNxdomainTotalsResponse implements ApiModel
{
    /**
     * @param int $listedNxdomainCount NXDOMAIN answers to all listed names in the window of `qtype`, not only those
     *     on this page
     * @param int|null $nxdomainCount All NXDOMAIN answers of the zone in the window, of all query types, from the
     *     daily zone statistics. These end yesterday at the latest, while the list includes today so far. Without
     *     `qtype` and with a window that ends yesterday at the latest, the difference to `listed_nxdomain_count` are
     *     names with at most 30 NXDOMAIN answers a day, which are not listed. Null when the daily statistics hold no
     *     day of the window
     */
    public function __construct(
        public int $listedNxdomainCount,
        public ?int $nxdomainCount = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            listedNxdomainCount: $data['listed_nxdomain_count'],
            nxdomainCount: $data['nxdomain_count'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'listed_nxdomain_count' => $this->listedNxdomainCount,
            'nxdomain_count' => $this->nxdomainCount,
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
