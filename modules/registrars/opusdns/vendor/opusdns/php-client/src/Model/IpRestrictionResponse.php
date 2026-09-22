<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class IpRestrictionResponse implements ApiModel
{
    /**
     * @param string $ipNetwork IP address or CIDR network range. Single IPs are returned with /32 (IPv4) or /128
     *     (IPv6) notation.
     * @param string $organizationId TypeID prefix: organization.
     */
    public function __construct(
        public \DateTimeImmutable $createdOn,
        public string $ipNetwork,
        public int $ipRestrictionId,
        public string $organizationId,
        public ?\DateTimeImmutable $lastUsedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            ipNetwork: $data['ip_network'],
            ipRestrictionId: $data['ip_restriction_id'],
            organizationId: $data['organization_id'],
            lastUsedOn: isset($data['last_used_on']) ? new \DateTimeImmutable($data['last_used_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'ip_network' => $this->ipNetwork,
            'ip_restriction_id' => $this->ipRestrictionId,
            'organization_id' => $this->organizationId,
            'last_used_on' => $this->lastUsedOn,
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
