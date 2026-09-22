<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\HttpProtocol;
use OpusDNS\Client\Enum\RedirectCode;
use OpusDNS\Client\Serializer;

final readonly class HttpRedirectListResponse implements ApiModel
{
    public function __construct(
        public RedirectCode|int $redirectCode,
        public string $requestHostname,
        public string $requestPath,
        public HttpProtocol|string $requestProtocol,
        public string $targetHostname,
        public string $targetPath,
        public HttpProtocol|string $targetProtocol,
        public bool $protected = false,
        public ?string $requestSubdomain = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            redirectCode: RedirectCode::tryFrom($data['redirect_code']) ?? $data['redirect_code'],
            requestHostname: $data['request_hostname'],
            requestPath: $data['request_path'],
            requestProtocol: HttpProtocol::tryFrom($data['request_protocol']) ?? $data['request_protocol'],
            targetHostname: $data['target_hostname'],
            targetPath: $data['target_path'],
            targetProtocol: HttpProtocol::tryFrom($data['target_protocol']) ?? $data['target_protocol'],
            protected: $data['protected'] ?? false,
            requestSubdomain: $data['request_subdomain'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'redirect_code' => $this->redirectCode,
            'request_hostname' => $this->requestHostname,
            'request_path' => $this->requestPath,
            'request_protocol' => $this->requestProtocol,
            'target_hostname' => $this->targetHostname,
            'target_path' => $this->targetPath,
            'target_protocol' => $this->targetProtocol,
            'protected' => $this->protected,
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
