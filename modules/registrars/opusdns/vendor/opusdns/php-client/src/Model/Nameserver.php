<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class Nameserver implements ApiModel
{
    /**
     * @param string $hostname The name server of the domain
     * @param list<string>|null $ipAddresses The ip addresses of the name server
     */
    public function __construct(
        public string $hostname,
        public ?array $ipAddresses = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            hostname: $data['hostname'],
            ipAddresses: $data['ip_addresses'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'hostname' => $this->hostname,
            'ip_addresses' => $this->ipAddresses,
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
