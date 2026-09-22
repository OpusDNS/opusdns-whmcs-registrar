<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class CommandError implements ApiModel
{
    /**
     * @param string $error Error message
     * @param int $index Index of the failed command in the request
     * @param string|null $code Stable semantic error code for known failure modes (e.g. 'ERROR_BATCH_EMPTY'); null
     *     for ad-hoc failures. Matches the 'code' field in top-level error responses.
     * @param int|null $instanceIndex Index within the bulk command's instances[] for per-instance failures
     * @param string|null $resourceKey Resource identifier (zone name, domain name, contact email) for per-instance
     *     failures
     * @param string|null $type RFC 9457 problem type identifier derived from the exception class (e.g. 'value',
     *     'batch-empty'). Matches the 'type' field in top-level error responses.
     */
    public function __construct(
        public string $error,
        public int $index,
        public ?string $code = null,
        public ?int $instanceIndex = null,
        public ?string $resourceKey = null,
        public ?string $type = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            error: $data['error'],
            index: $data['index'],
            code: $data['code'] ?? null,
            instanceIndex: $data['instance_index'] ?? null,
            resourceKey: $data['resource_key'] ?? null,
            type: $data['type'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'error' => $this->error,
            'index' => $this->index,
            'code' => $this->code,
            'instance_index' => $this->instanceIndex,
            'resource_key' => $this->resourceKey,
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
