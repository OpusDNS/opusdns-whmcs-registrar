<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\RegistryServiceBackend;
use OpusDNS\Client\Serializer;

final readonly class DomainAmsAccountResponse implements ApiModel
{
    /**
     * @param RegistryServiceBackend|string $registry The registry the account is accredited at
     * @param string $registryAccountId The registry account the domain is held on TypeID prefix: registry_account.
     * @param string $type Kind of connected account. `ams`: the organization's own registry accreditation, on which
     *     OpusDNS manages the domain.
     */
    public function __construct(
        public RegistryServiceBackend|string $registry,
        public string $registryAccountId,
        public string $type = 'ams',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            registry: RegistryServiceBackend::tryFrom($data['registry']) ?? $data['registry'],
            registryAccountId: $data['registry_account_id'],
            type: $data['type'] ?? 'ams',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'registry' => $this->registry,
            'registry_account_id' => $this->registryAccountId,
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
