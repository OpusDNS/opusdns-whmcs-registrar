<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainClientStatus;
use OpusDNS\Client\Serializer;

final readonly class StatusChanges implements ApiModel
{
    /**
     * @param list<DomainClientStatus|string>|null $add Statuses to add to the domain
     * @param list<DomainClientStatus|string>|null $remove Statuses to remove from the domain
     */
    public function __construct(
        public ?array $add = null,
        public ?array $remove = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            add: isset($data['add']) ? array_map(static fn (string $item): DomainClientStatus|string => DomainClientStatus::tryFrom($item) ?? $item, $data['add']) : null,
            remove: isset($data['remove']) ? array_map(static fn (string $item): DomainClientStatus|string => DomainClientStatus::tryFrom($item) ?? $item, $data['remove']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'add' => $this->add,
            'remove' => $this->remove,
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
