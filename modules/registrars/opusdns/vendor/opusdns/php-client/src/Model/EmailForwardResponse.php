<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardResponse implements ApiModel
{
    /**
     * @param list<EmailForwardAlias> $aliases
     * @param string $emailForwardId TypeID prefix: email_forward.
     */
    public function __construct(
        public array $aliases,
        public \DateTimeImmutable $createdOn,
        public string $emailForwardId,
        public bool $enabled,
        public string $hostname,
        public \DateTimeImmutable $updatedOn,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            aliases: array_map(static fn (array $item): EmailForwardAlias => EmailForwardAlias::fromArray($item), $data['aliases']),
            createdOn: new \DateTimeImmutable($data['created_on']),
            emailForwardId: $data['email_forward_id'],
            enabled: $data['enabled'],
            hostname: $data['hostname'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'aliases' => $this->aliases,
            'created_on' => $this->createdOn,
            'email_forward_id' => $this->emailForwardId,
            'enabled' => $this->enabled,
            'hostname' => $this->hostname,
            'updated_on' => $this->updatedOn,
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
