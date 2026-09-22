<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\IPAddressType;
use OpusDNS\Client\Serializer;

final readonly class HostIpSchema implements ApiModel
{
    /**
     * @param string $address IP address of the host object
     * @param IPAddressType|string $type IP address type
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param string|null $hostId TypeID prefix: host.
     * @param string|null $hostIpId TypeID prefix: host_ip.
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     */
    public function __construct(
        public string $address,
        public IPAddressType|string $type,
        public ?\DateTimeImmutable $createdOn = null,
        public ?string $hostId = null,
        public ?string $hostIpId = null,
        public ?\DateTimeImmutable $updatedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            address: $data['address'],
            type: IPAddressType::tryFrom($data['type']) ?? $data['type'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            hostId: $data['host_id'] ?? null,
            hostIpId: $data['host_ip_id'] ?? null,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'address' => $this->address,
            'type' => $this->type,
            'created_on' => $this->createdOn,
            'host_id' => $this->hostId,
            'host_ip_id' => $this->hostIpId,
            'updated_on' => $this->updatedOn,
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
