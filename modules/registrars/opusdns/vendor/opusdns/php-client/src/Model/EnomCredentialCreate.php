<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class EnomCredentialCreate implements ApiModel
{
    /**
     * @param EnomCredentials $credentials Login details for the account; the fields depend on `registrar`
     * @param string $name Your name for this connection, unique per registrar
     * @param string $registrar The registrar the account is at
     */
    public function __construct(
        public readonly EnomCredentials $credentials,
        public readonly string $name,
        public readonly string $registrar = 'ENOM',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            credentials: EnomCredentials::fromArray($data['credentials']),
            name: $data['name'],
            registrar: $data['registrar'] ?? 'ENOM',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'credentials' => $this->credentials,
            'name' => $this->name,
            'registrar' => $this->registrar,
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
