<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class NicManagerCredentials implements ApiModel
{
    /**
     * @param string $password Password at the registrar
     * @param string $username User name at the registrar
     * @param string|null $otp Auth token, if your NicManager account requires one
     */
    public function __construct(
        public readonly string $password,
        public readonly string $username,
        public readonly ?string $otp = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            password: $data['password'],
            username: $data['username'],
            otp: $data['otp'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'password' => $this->password,
            'username' => $this->username,
            'otp' => $this->otp,
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
