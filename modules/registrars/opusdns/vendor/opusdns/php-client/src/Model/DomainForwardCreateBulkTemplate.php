<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainForwardCreateBulkTemplate implements ApiModel
{
    /**
     * @param bool $autoCreateZone Create apex DNS zone automatically when missing
     * @param bool $enabled Whether domain forward should be enabled
     * @param DomainForwardProtocolSetRequest|null $http HTTP redirect definitions
     * @param DomainForwardProtocolSetRequest|null $https HTTPS redirect definitions
     */
    public function __construct(
        public bool $autoCreateZone = false,
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
            autoCreateZone: $data['auto_create_zone'] ?? false,
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
            'auto_create_zone' => $this->autoCreateZone,
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
