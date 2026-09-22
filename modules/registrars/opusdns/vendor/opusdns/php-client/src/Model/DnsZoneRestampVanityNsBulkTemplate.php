<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DnsZoneRestampVanityNsBulkTemplate implements ApiModel
{
    /**
     * @param string|null $vanityNameserverSetId Vanity NS set to restamp every zone's apex NS + SOA with, or null to
     *     unbrand all zones back to OpusDNS system default nameservers. An instance may override this.
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
