<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class UserTokenResponse implements ApiModel
{
    public function __construct(
        public string $accessToken,
        public int $expiresIn,
        public int $refreshExpiresIn,
        public string $refreshToken,
        public string $tokenType = 'Bearer',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            accessToken: $data['access_token'],
            expiresIn: $data['expires_in'],
            refreshExpiresIn: $data['refresh_expires_in'],
            refreshToken: $data['refresh_token'],
            tokenType: $data['token_type'] ?? 'Bearer',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'access_token' => $this->accessToken,
            'expires_in' => $this->expiresIn,
            'refresh_expires_in' => $this->refreshExpiresIn,
            'refresh_token' => $this->refreshToken,
            'token_type' => $this->tokenType,
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
