<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\Registrar;
use OpusDNS\Client\Serializer;

final class DomainRegistrarCredentialResponse implements ApiModel
{
    /**
     * @param string $name Your name for this connection
     * @param Registrar|string $registrar The registrar the account is at
     * @param string $registrarCredentialId ID of the connected account TypeID prefix: registrar_credential.
     * @param string $type Kind of connected account. `ras`: a registrar credential managed under
     *     `/v1/connect/registrars`.
     */
    public function __construct(
        public readonly string $name,
        public readonly Registrar|string $registrar,
        public readonly string $registrarCredentialId,
        public readonly string $type = 'ras',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            registrar: Registrar::tryFrom($data['registrar']) ?? $data['registrar'],
            registrarCredentialId: $data['registrar_credential_id'],
            type: $data['type'] ?? 'ras',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'registrar' => $this->registrar,
            'registrar_credential_id' => $this->registrarCredentialId,
            'type' => $this->type,
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
