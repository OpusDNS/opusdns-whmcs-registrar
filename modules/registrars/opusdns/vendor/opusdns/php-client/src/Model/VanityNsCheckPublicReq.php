<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * Public `/check` request body. The owning org comes from auth context, so only the set identifier is
 * accepted here.
 */
final readonly class VanityNsCheckPublicReq implements ApiModel
{
    /**
     * @param string $setId The vanity NS set to diagnose TypeID prefix: vns.
     */
    public function __construct(
        public string $setId,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            setId: $data['set_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'set_id' => $this->setId,
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
