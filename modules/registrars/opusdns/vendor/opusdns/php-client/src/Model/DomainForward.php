<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainForward implements ApiModel
{
    /**
     * @param string $domainForwardId TypeID prefix: domain_forward.
     */
    public function __construct(
        public \DateTimeImmutable $createdOn,
        public string $domainForwardId,
        public bool $enabled,
        public string $hostname,
        public \DateTimeImmutable $updatedOn,
        public ?DomainForwardProtocolSetResponse $http = null,
        public ?DomainForwardProtocolSetResponse $https = null,
        public ?string $parkingId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            domainForwardId: $data['domain_forward_id'],
            enabled: $data['enabled'],
            hostname: $data['hostname'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            http: isset($data['http']) ? DomainForwardProtocolSetResponse::fromArray($data['http']) : null,
            https: isset($data['https']) ? DomainForwardProtocolSetResponse::fromArray($data['https']) : null,
            parkingId: $data['parking_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'domain_forward_id' => $this->domainForwardId,
            'enabled' => $this->enabled,
            'hostname' => $this->hostname,
            'updated_on' => $this->updatedOn,
            'http' => $this->http,
            'https' => $this->https,
            'parking_id' => $this->parkingId,
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
