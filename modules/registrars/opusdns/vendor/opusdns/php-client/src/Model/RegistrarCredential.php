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

final class RegistrarCredential implements ApiModel
{
    /**
     * @param \DateTimeImmutable $createdOn When the account was connected
     * @param string $name Your name for this connection
     * @param string $organizationId Organization the account is connected to TypeID prefix: organization.
     * @param Registrar|string $registrar The registrar the account is at
     * @param string $registrarCredentialId ID of the connected account TypeID prefix: registrar_credential.
     * @param \DateTimeImmutable $updatedOn When the account last changed
     */
    public function __construct(
        public readonly \DateTimeImmutable $createdOn,
        public readonly string $name,
        public readonly string $organizationId,
        public readonly Registrar|string $registrar,
        public readonly string $registrarCredentialId,
        public readonly \DateTimeImmutable $updatedOn,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            name: $data['name'],
            organizationId: $data['organization_id'],
            registrar: Registrar::tryFrom($data['registrar']) ?? $data['registrar'],
            registrarCredentialId: $data['registrar_credential_id'],
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
            'name' => $this->name,
            'organization_id' => $this->organizationId,
            'registrar' => $this->registrar,
            'registrar_credential_id' => $this->registrarCredentialId,
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
