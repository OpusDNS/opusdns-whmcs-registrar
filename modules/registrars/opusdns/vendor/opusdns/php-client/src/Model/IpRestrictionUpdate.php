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
 * Update an existing IP restriction.
 *
 * You can update the IP network range or the last usage timestamp.
 */
final readonly class IpRestrictionUpdate implements ApiModel
{
    /**
     * @param string|null $ipNetwork IP address or CIDR network range to replace the existing restriction.
     * @param \DateTimeImmutable|null $lastUsedOn Timestamp of the last usage.
     */
    public function __construct(
        public ?string $ipNetwork = null,
        public ?\DateTimeImmutable $lastUsedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            ipNetwork: $data['ip_network'] ?? null,
            lastUsedOn: isset($data['last_used_on']) ? new \DateTimeImmutable($data['last_used_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'ip_network' => $this->ipNetwork,
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
