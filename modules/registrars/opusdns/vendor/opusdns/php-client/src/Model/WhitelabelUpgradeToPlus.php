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
 * Upgrade the whitelabel to the plus tier, served on the customer's own domain. This is NOT a term
 * change: the subscription keeps its period and renewal date and simply renews at the plus price. A
 * yearly upgrade bills a one-time prorated difference for the remaining whole months; a monthly
 * upgrade bills nothing now. Downgrades (plus -> base) are not supported - cancel + rebook instead -
 * so this body only ever moves to plus (no tier field, no period).
 */
final readonly class WhitelabelUpgradeToPlus implements ApiModel
{
    /**
     * @param string $authSubdomain Subdomain the login is served on (e.g. auth -> auth.customer.com)
     * @param string $hostname Domain the whitelabel runs under (e.g. customer.com); an OpusDNS-hosted zone owned by
     *     the org
     * @param bool $createZone Create the OpusDNS-hosted DNS zone for this domain during onboarding if it does not
     *     already exist, instead of requiring it to exist beforehand. The domain must still be delegated to the
     *     OpusDNS nameservers for verification to pass. The dashboard sends true; other API callers opt in
     *     explicitly.
     * @param string|null $dashboardSubdomain Subdomain the dashboard is served on (e.g. dash -> dash.customer.com);
     *     omit for apex
     */
    public function __construct(
        public string $authSubdomain,
        public string $hostname,
        public bool $createZone = false,
        public ?string $dashboardSubdomain = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            authSubdomain: $data['auth_subdomain'],
            hostname: $data['hostname'],
            createZone: $data['create_zone'] ?? false,
            dashboardSubdomain: $data['dashboard_subdomain'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'auth_subdomain' => $this->authSubdomain,
            'hostname' => $this->hostname,
            'create_zone' => $this->createZone,
            'dashboard_subdomain' => $this->dashboardSubdomain,
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
