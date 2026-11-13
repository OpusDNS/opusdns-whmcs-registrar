<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\HttpProtocol;
use OpusDNS\Client\Serializer;

final class HttpRedirectRemove implements ApiModel
{
    public function __construct(
        public readonly string $requestHostname,
        public readonly string $requestPath,
        public readonly HttpProtocol|string $requestProtocol,
        public readonly ?string $requestSubdomain = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            requestHostname: $data['request_hostname'],
            requestPath: $data['request_path'],
            requestProtocol: HttpProtocol::tryFrom($data['request_protocol']) ?? $data['request_protocol'],
            requestSubdomain: $data['request_subdomain'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'request_hostname' => $this->requestHostname,
            'request_path' => $this->requestPath,
            'request_protocol' => $this->requestProtocol,
            'request_subdomain' => $this->requestSubdomain,
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
