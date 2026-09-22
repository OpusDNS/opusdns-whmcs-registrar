<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainStatus;
use OpusDNS\Client\Serializer;

final readonly class DomainStatusesBase implements ApiModel
{
    /**
     * @param list<string> $default The default status for an active domain with no restrictions
     * @param list<string> $supportedStatuses Supported domain statuses
     * @param array<string, list<DomainStatus|string>>|null $statusMapping Mapping of registry-specific statuses to
     *     their equivalent default ones, if any
     */
    public function __construct(
        public array $default,
        public array $supportedStatuses,
        public ?array $statusMapping = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            default: $data['default'],
            supportedStatuses: $data['supported_statuses'],
            statusMapping: isset($data['status_mapping']) ? array_map(static fn (array $value): array => array_map(static fn (string $item): DomainStatus|string => DomainStatus::tryFrom($item) ?? $item, $value), (array) $data['status_mapping']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'default' => $this->default,
            'supported_statuses' => $this->supportedStatuses,
            'status_mapping' => $this->statusMapping === null ? null : ($this->statusMapping === [] ? new \stdClass() : $this->statusMapping),
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
