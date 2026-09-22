<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardCreateBulkInstance implements ApiModel
{
    /**
     * @param string $hostname Hostname to create email forwarding for
     * @param list<EmailForwardAliasCreate>|null $aliases Override aliases
     * @param bool|null $enabled Override enabled setting for this hostname
     */
    public function __construct(
        public string $hostname,
        public ?array $aliases = null,
        public ?bool $enabled = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            hostname: $data['hostname'],
            aliases: isset($data['aliases']) ? array_map(static fn (array $item): EmailForwardAliasCreate => EmailForwardAliasCreate::fromArray($item), $data['aliases']) : null,
            enabled: $data['enabled'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'hostname' => $this->hostname,
            'aliases' => $this->aliases,
            'enabled' => $this->enabled,
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
