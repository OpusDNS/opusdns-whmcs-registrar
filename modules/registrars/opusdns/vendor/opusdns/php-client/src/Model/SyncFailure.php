<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * A domain the sync could not sync. The list can be shorter than the status's `failed` count.
 */
final class SyncFailure implements ApiModel
{
    /**
     * @param string $batchId ID of the sync it belongs to, as in Get sync status
     * @param \DateTimeImmutable $createdOn When the failure happened
     * @param string $domainName The domain name, spelled as in the domains API
     * @param SyncFailureError $error Why the domain could not be synced
     */
    public function __construct(
        public readonly string $batchId,
        public readonly \DateTimeImmutable $createdOn,
        public readonly string $domainName,
        public readonly SyncFailureError $error,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            batchId: $data['batch_id'],
            createdOn: new \DateTimeImmutable($data['created_on']),
            domainName: $data['domain_name'],
            error: SyncFailureError::fromArray($data['error']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'batch_id' => $this->batchId,
            'created_on' => $this->createdOn,
            'domain_name' => $this->domainName,
            'error' => $this->error,
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
