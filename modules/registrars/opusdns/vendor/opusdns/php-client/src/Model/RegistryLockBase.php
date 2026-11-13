<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class RegistryLockBase implements ApiModel
{
    /**
     * @param bool $supported Whether the registry provides a Registry Lock feature
     * @param list<string>|null $prevents What operations are prevented by registry lock
     * @param string|null $removalProcess Process for unlocking the domain
     * @param bool|null $requiresManualRequest Whether a manual request is required
     */
    public function __construct(
        public readonly bool $supported,
        public readonly ?array $prevents = null,
        public readonly ?string $removalProcess = null,
        public readonly ?bool $requiresManualRequest = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            supported: $data['supported'],
            prevents: $data['prevents'] ?? null,
            removalProcess: $data['removal_process'] ?? null,
            requiresManualRequest: $data['requires_manual_request'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'supported' => $this->supported,
            'prevents' => $this->prevents,
            'removal_process' => $this->removalProcess,
            'requires_manual_request' => $this->requiresManualRequest,
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
