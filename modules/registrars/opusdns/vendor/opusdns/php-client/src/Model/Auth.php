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
 * Pre-login OAuth bootstrap. The SPA resolves this document by hostname before login and uses
 * `client_id` (the org's `wl-<organization_id>` Keycloak client) + `authority` (the OIDC issuer on the
 * customer's auth host) to start the flow; absent, it falls back to the default dashboard client.
 *
 * System-owned: written only by onboarding (via branding-service's set-auth endpoint), never by a
 * customer document write - branding-service preserves this block across customer upserts.
 */
final readonly class Auth implements ApiModel
{
    public function __construct(
        public ?string $authority = null,
        public ?string $clientId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            authority: $data['authority'] ?? null,
            clientId: $data['client_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'authority' => $this->authority,
            'client_id' => $this->clientId,
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
