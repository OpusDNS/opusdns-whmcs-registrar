<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainForwardCreateRequest implements ApiModel
{
    public function __construct(
        public string $hostname,
        public bool $enabled = false,
        public ?DomainForwardProtocolSetRequest $http = null,
        public ?DomainForwardProtocolSetRequest $https = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            hostname: $data['hostname'],
            enabled: $data['enabled'] ?? false,
            http: isset($data['http']) ? DomainForwardProtocolSetRequest::fromArray($data['http']) : null,
            https: isset($data['https']) ? DomainForwardProtocolSetRequest::fromArray($data['https']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'hostname' => $this->hostname,
            'enabled' => $this->enabled,
            'http' => $this->http,
            'https' => $this->https,
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
