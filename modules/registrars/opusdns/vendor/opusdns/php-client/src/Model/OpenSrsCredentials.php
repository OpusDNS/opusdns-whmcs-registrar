<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class OpenSrsCredentials implements ApiModel
{
    /**
     * @param string $apiKey Reseller API key at OpenSRS
     * @param string $username Reseller user name at OpenSRS
     */
    public function __construct(
        public readonly string $apiKey,
        public readonly string $username,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            apiKey: $data['api_key'],
            username: $data['username'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'api_key' => $this->apiKey,
            'username' => $this->username,
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
