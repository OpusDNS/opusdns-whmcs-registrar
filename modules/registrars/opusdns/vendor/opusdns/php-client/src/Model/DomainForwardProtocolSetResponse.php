<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainForwardProtocolSetResponse implements ApiModel
{
    /**
     * @param list<HttpRedirectListResponse> $redirects
     */
    public function __construct(
        public \DateTimeImmutable $createdOn,
        public array $redirects,
        public \DateTimeImmutable $updatedOn,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            redirects: array_map(static fn (array $item): HttpRedirectListResponse => HttpRedirectListResponse::fromArray($item), $data['redirects']),
            updatedOn: new \DateTimeImmutable($data['updated_on']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'redirects' => $this->redirects,
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
