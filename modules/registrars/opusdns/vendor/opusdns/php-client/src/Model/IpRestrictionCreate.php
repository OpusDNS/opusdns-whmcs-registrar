<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * Create an IP restriction for an organization.
 *
 * Accepts either a single IP address or a CIDR network range. Individual IP addresses are stored and
 * returned with CIDR notation (/32 for IPv4, /128 for IPv6).
 */
final readonly class IpRestrictionCreate implements ApiModel
{
    /**
     * @param string $ipNetwork IP address or CIDR network range. Individual IPs can be specified without CIDR
     *     notation.
     * @param string|null $organizationId TypeID prefix: organization.
     */
    public function __construct(
        public string $ipNetwork,
        public ?string $organizationId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            ipNetwork: $data['ip_network'],
            organizationId: $data['organization_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'ip_network' => $this->ipNetwork,
            'organization_id' => $this->organizationId,
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
