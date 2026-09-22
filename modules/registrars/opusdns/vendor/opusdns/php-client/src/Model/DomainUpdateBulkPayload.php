<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainUpdateBulkPayload implements ApiModel
{
    /**
     * @param list<DomainUpdateBulkInstance> $instances List of domains to update (1-1000)
     * @param DomainUpdateBulkTemplate $template Shared settings for all domain updates
     */
    public function __construct(
        public array $instances,
        public DomainUpdateBulkTemplate $template,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            instances: array_map(static fn (array $item): DomainUpdateBulkInstance => DomainUpdateBulkInstance::fromArray($item), $data['instances']),
            template: DomainUpdateBulkTemplate::fromArray($data['template']),
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
