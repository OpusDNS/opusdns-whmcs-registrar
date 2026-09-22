<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class SetVanityNameserverSetDefaultRes implements ApiModel
{
    /**
     * @param VanityNameserverSetDTO $vanityNameserverSet The set that is now the org's default (or unchanged set on
     *     a no-op 200).
     */
    public function __construct(
        public VanityNameserverSetDTO $vanityNameserverSet,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            vanityNameserverSet: VanityNameserverSetDTO::fromArray($data['vanity_nameserver_set']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'vanity_nameserver_set' => $this->vanityNameserverSet,
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
