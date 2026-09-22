<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\HostStatus;
use OpusDNS\Client\Serializer;

final readonly class HostSchema implements ApiModel
{
    /**
     * @param string $hostname Hostname of the host object
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param string|null $domainId The domain that the host object belongs to TypeID prefix: domain.
     * @param string|null $hostId TypeID prefix: host.
     * @param string|null $registryAccountId The registry account that the host object belongs to
     * @param HostStatus|string $status Status of the host object
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     */
    public function __construct(
        public string $hostname,
        public ?\DateTimeImmutable $createdOn = null,
        public ?string $domainId = null,
        public ?string $hostId = null,
        public ?string $registryAccountId = null,
        public HostStatus|string $status = HostStatus::INACTIVE,
        public ?\DateTimeImmutable $updatedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            hostname: $data['hostname'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            domainId: $data['domain_id'] ?? null,
            hostId: $data['host_id'] ?? null,
            registryAccountId: $data['registry_account_id'] ?? null,
            status: isset($data['status']) ? HostStatus::tryFrom($data['status']) ?? $data['status'] : HostStatus::INACTIVE,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'hostname' => $this->hostname,
            'created_on' => $this->createdOn,
            'domain_id' => $this->domainId,
            'host_id' => $this->hostId,
            'registry_account_id' => $this->registryAccountId,
            'status' => $this->status,
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
