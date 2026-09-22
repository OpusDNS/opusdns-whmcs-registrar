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

final readonly class DomainForwardSetCreateRequest implements ApiModel
{
    /**
     * @param list<HttpRedirectRequest> $redirects
     */
    public function __construct(
        public HttpProtocol|string $protocol,
        public array $redirects,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            protocol: HttpProtocol::tryFrom($data['protocol']) ?? $data['protocol'],
            redirects: array_map(static fn (array $item): HttpRedirectRequest => HttpRedirectRequest::fromArray($item), $data['redirects']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'protocol' => $this->protocol,
            'redirects' => $this->redirects,
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
