<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardUpdateBulkTemplate implements ApiModel
{
    /**
     * @param bool $enabled Whether email forwarding should be enabled
     * @param list<EmailForwardAliasCreate>|null $aliases Aliases to set (replace-all)
     */
    public function __construct(
        public bool $enabled,
        public ?array $aliases = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            enabled: $data['enabled'],
            aliases: isset($data['aliases']) ? array_map(static fn (array $item): EmailForwardAliasCreate => EmailForwardAliasCreate::fromArray($item), $data['aliases']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'enabled' => $this->enabled,
            'aliases' => $this->aliases,
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
