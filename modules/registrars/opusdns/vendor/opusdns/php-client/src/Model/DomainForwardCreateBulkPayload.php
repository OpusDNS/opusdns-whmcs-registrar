<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainForwardCreateBulkPayload implements ApiModel
{
    /**
     * @param list<DomainForwardCreateBulkInstance> $instances List of domain forwards to create (1-1000)
     * @param DomainForwardCreateBulkTemplate $template Shared settings for all domain forwards
     */
    public function __construct(
        public array $instances,
        public DomainForwardCreateBulkTemplate $template,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            instances: array_map(static fn (array $item): DomainForwardCreateBulkInstance => DomainForwardCreateBulkInstance::fromArray($item), $data['instances']),
            template: DomainForwardCreateBulkTemplate::fromArray($data['template']),
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
