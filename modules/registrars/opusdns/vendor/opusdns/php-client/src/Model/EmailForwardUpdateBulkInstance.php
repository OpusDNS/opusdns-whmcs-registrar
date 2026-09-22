<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardUpdateBulkInstance implements ApiModel
{
    /**
     * @param list<EmailForwardAliasCreate>|null $aliases Override aliases (replace-all)
     * @param string|null $emailForwardId Email forward ID to target
     * @param bool|null $enabled Override enabled setting
     * @param string|null $hostname Hostname to target
     */
    public function __construct(
        public ?array $aliases = null,
        public ?string $emailForwardId = null,
        public ?bool $enabled = null,
        public ?string $hostname = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            aliases: isset($data['aliases']) ? array_map(static fn (array $item): EmailForwardAliasCreate => EmailForwardAliasCreate::fromArray($item), $data['aliases']) : null,
            emailForwardId: $data['email_forward_id'] ?? null,
            enabled: $data['enabled'] ?? null,
            hostname: $data['hostname'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'aliases' => $this->aliases,
            'email_forward_id' => $this->emailForwardId,
            'enabled' => $this->enabled,
            'hostname' => $this->hostname,
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
