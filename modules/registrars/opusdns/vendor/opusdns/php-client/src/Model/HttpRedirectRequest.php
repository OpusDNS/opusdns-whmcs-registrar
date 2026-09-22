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

final readonly class HttpRedirectRequest implements ApiModel
{
    public function __construct(
        public RedirectCode|int $redirectCode,
        public string $requestPath,
        public string $targetHostname,
        public string $targetPath,
        public HttpProtocol|string $targetProtocol,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            redirectCode: RedirectCode::tryFrom($data['redirect_code']) ?? $data['redirect_code'],
            requestPath: $data['request_path'],
            targetHostname: $data['target_hostname'],
            targetPath: $data['target_path'],
            targetProtocol: HttpProtocol::tryFrom($data['target_protocol']) ?? $data['target_protocol'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'redirect_code' => $this->redirectCode,
            'request_path' => $this->requestPath,
            'target_hostname' => $this->targetHostname,
            'target_path' => $this->targetPath,
            'target_protocol' => $this->targetProtocol,
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
