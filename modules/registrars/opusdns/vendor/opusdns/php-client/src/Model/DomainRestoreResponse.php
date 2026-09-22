<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainRestoreResponse implements ApiModel
{
    /**
     * @param string $domainId The ID of the restored domain TypeID prefix: domain.
     * @param string $name The name of the restored domain
     * @param \DateTimeImmutable $restoredAt When the domain restore operation was completed
     */
    public function __construct(
        public string $domainId,
        public string $name,
        public \DateTimeImmutable $restoredAt,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            domainId: $data['domain_id'],
            name: $data['name'],
            restoredAt: new \DateTimeImmutable($data['restored_at']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'domain_id' => $this->domainId,
            'name' => $this->name,
            'restored_at' => $this->restoredAt,
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
