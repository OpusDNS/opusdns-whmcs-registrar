<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class HostResponse implements ApiModel
{
    /**
     * @param \DateTimeImmutable $createdOn Timestamp when the host was created
     * @param string $hostId Unique identifier of the host object TypeID prefix: host.
     * @param string $hostname Hostname of the host object
     * @param \DateTimeImmutable $updatedOn Timestamp when the host was last updated
     * @param list<string>|null $ipAddresses The ip addresses of the Host Object
     */
    public function __construct(
        public \DateTimeImmutable $createdOn,
        public string $hostId,
        public string $hostname,
        public \DateTimeImmutable $updatedOn,
        public ?array $ipAddresses = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            hostId: $data['host_id'],
            hostname: $data['hostname'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            ipAddresses: $data['ip_addresses'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'host_id' => $this->hostId,
            'hostname' => $this->hostname,
            'updated_on' => $this->updatedOn,
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
