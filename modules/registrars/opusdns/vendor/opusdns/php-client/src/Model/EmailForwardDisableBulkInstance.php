<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardDisableBulkInstance implements ApiModel
{
    /**
     * @param string|null $emailForwardId Email forward ID to target
     * @param string|null $hostname Hostname to target
     */
    public function __construct(
        public ?string $emailForwardId = null,
        public ?string $hostname = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            emailForwardId: $data['email_forward_id'] ?? null,
            hostname: $data['hostname'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'email_forward_id' => $this->emailForwardId,
            'hostname' => $this->hostname,
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
