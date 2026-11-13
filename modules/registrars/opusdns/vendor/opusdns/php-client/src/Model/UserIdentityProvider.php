<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class UserIdentityProvider implements ApiModel
{
    /**
     * @param string $displayName The identity provider's display name
     * @param string $identityProviderId The identity provider's id TypeID prefix: idp.
     */
    public function __construct(
        public readonly string $displayName,
        public readonly string $identityProviderId,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            displayName: $data['display_name'],
            identityProviderId: $data['identity_provider_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'display_name' => $this->displayName,
            'identity_provider_id' => $this->identityProviderId,
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
