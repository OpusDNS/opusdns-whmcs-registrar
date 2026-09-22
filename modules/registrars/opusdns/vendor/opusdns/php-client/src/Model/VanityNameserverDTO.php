<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class VanityNameserverDTO implements ApiModel
{
    /**
     * @param string $hostname Fully-qualified hostname of the vanity nameserver
     * @param int $position Ordering within the set; lowest position becomes SOA MNAME
     */
    public function __construct(
        public string $hostname,
        public int $position,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            hostname: $data['hostname'],
            position: $data['position'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'hostname' => $this->hostname,
            'position' => $this->position,
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
