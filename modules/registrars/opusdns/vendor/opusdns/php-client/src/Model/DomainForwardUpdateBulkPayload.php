<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainForwardUpdateBulkPayload implements ApiModel
{
    /**
     * @param list<DomainForwardUpdateBulkInstance> $instances List of domain forwards to update (1-1000)
     * @param DomainForwardUpdateBulkTemplate $template Shared settings for all domain forwards
     */
    public function __construct(
        public array $instances,
        public DomainForwardUpdateBulkTemplate $template,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            instances: array_map(static fn (array $item): DomainForwardUpdateBulkInstance => DomainForwardUpdateBulkInstance::fromArray($item), $data['instances']),
            template: DomainForwardUpdateBulkTemplate::fromArray($data['template']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'instances' => $this->instances,
            'template' => $this->template,
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
