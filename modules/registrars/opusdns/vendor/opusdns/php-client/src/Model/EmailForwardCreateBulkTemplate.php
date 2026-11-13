<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class EmailForwardCreateBulkTemplate implements ApiModel
{
    /**
     * @param list<EmailForwardAliasCreate>|null $aliases Aliases to create
     * @param bool $autoCreateZone Create apex DNS zone automatically when missing
     * @param bool $enabled Whether email forwarding should be enabled
     */
    public function __construct(
        public readonly ?array $aliases = null,
        public readonly bool $autoCreateZone = false,
        public readonly bool $enabled = false,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            aliases: isset($data['aliases']) ? array_map(static fn (array $item): EmailForwardAliasCreate => EmailForwardAliasCreate::fromArray($item), $data['aliases']) : null,
            autoCreateZone: $data['auto_create_zone'] ?? false,
            enabled: $data['enabled'] ?? false,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'aliases' => $this->aliases,
            'auto_create_zone' => $this->autoCreateZone,
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
