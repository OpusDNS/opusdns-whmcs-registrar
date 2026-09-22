<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class TransferLockPolicyBase implements ApiModel
{
    /**
     * @param bool $supportedByRegistrar Whether the registrar supports transfer locks
     * @param bool $supportedByRegistry Whether the registry supports transfer locks
     */
    public function __construct(
        public bool $supportedByRegistrar,
        public bool $supportedByRegistry,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            supportedByRegistrar: $data['supported_by_registrar'],
            supportedByRegistry: $data['supported_by_registry'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'supported_by_registrar' => $this->supportedByRegistrar,
            'supported_by_registry' => $this->supportedByRegistry,
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
