<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardAlias implements ApiModel
{
    /**
     * @param string $emailForwardAliasId TypeID prefix: email_forward_alias.
     * @param list<string> $forwardTo
     */
    public function __construct(
        public string $alias,
        public string $emailForwardAliasId,
        public array $forwardTo,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            alias: $data['alias'],
            emailForwardAliasId: $data['email_forward_alias_id'],
            forwardTo: $data['forward_to'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'alias' => $this->alias,
            'email_forward_alias_id' => $this->emailForwardAliasId,
            'forward_to' => $this->forwardTo,
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
