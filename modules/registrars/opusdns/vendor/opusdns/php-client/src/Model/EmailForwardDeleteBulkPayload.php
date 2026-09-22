<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardDeleteBulkPayload implements ApiModel
{
    /**
     * @param list<EmailForwardDeleteBulkInstance> $instances List of email forwards to delete (1-1000)
     */
    public function __construct(
        public array $instances,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            instances: array_map(static fn (array $item): EmailForwardDeleteBulkInstance => EmailForwardDeleteBulkInstance::fromArray($item), $data['instances']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'instances' => $this->instances,
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
