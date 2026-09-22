<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainCreateBulkPayload implements ApiModel
{
    /**
     * @param list<DomainCreateBulkInstance> $instances List of domains to create (1-1000)
     * @param DomainCreateBulkTemplate $template Shared settings for all domains
     */
    public function __construct(
        public array $instances,
        public DomainCreateBulkTemplate $template,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            instances: array_map(static fn (array $item): DomainCreateBulkInstance => DomainCreateBulkInstance::fromArray($item), $data['instances']),
            template: DomainCreateBulkTemplate::fromArray($data['template']),
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
