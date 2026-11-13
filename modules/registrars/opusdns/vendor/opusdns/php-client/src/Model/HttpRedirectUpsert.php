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

final class HttpRedirectUpsert implements ApiModel
{
    /**
     * @param string $requestPath Path to redirect. Matched exactly, ignoring a trailing slash: `/` matches only the
     *     start page. `*` stands for whole path segments: `/*` matches every path, `/docs/*` matches `/docs` and
     *     everything below it, `/a/* /c` matches any one segment in place of `*`. A `*` inside a segment, as in
     *     `/blog*`, is matched literally. An exact path wins over a wildcard.
     * @param string $targetHostname Hostname to redirect to, without protocol or path, e.g. `www.example.org`.
     * @param string $targetPath Path to redirect to. A `*` is replaced by the part of the request path that the
     *     wildcard in `request_path` matched: with `request_path` `/*`, `target_path` `/*` keeps the path and `/`
     *     sends every path to the start page. The request's query string is appended.
     */
    public function __construct(
        public readonly RedirectCode|int $redirectCode,
        public readonly string $requestHostname,
        public readonly string $requestPath,
        public readonly HttpProtocol|string $requestProtocol,
        public readonly string $targetHostname,
        public readonly string $targetPath,
        public readonly HttpProtocol|string $targetProtocol,
        public readonly ?string $requestSubdomain = null,
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
