<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class OpenSrsCredentialUpdate implements ApiModel
{
    /**
     * @param OpenSrsCredentials $credentials Login details for the account; the fields depend on `registrar`
     * @param string $registrar The registrar the account is at
     */
    public function __construct(
        public readonly OpenSrsCredentials $credentials,
        public readonly string $registrar = 'OPENSRS',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            credentials: OpenSrsCredentials::fromArray($data['credentials']),
            registrar: $data['registrar'] ?? 'OPENSRS',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'credentials' => $this->credentials,
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
