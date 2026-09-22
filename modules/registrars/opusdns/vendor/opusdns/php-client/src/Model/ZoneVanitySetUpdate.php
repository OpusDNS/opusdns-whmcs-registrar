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
 * Public request body for assigning/clearing a zone's vanity NS branding.
 */
final readonly class ZoneVanitySetUpdate implements ApiModel
{
    /**
     * @param string|null $vanityNameserverSetId Vanity NS set to brand the zone's apex NS + SOA with, or null to
     *     unassign and restamp the apex back to OpusDNS system defaults.
     */
    public function __construct(
        public ?string $vanityNameserverSetId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            vanityNameserverSetId: $data['vanity_nameserver_set_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'vanity_nameserver_set_id' => $this->vanityNameserverSetId,
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
