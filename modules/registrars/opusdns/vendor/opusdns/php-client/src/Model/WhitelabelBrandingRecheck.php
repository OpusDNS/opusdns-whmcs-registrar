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
 * Public recheck body. Empty = re-run onboarding against the stored hosts (retry after fixing DNS).
 * hostname + auth_subdomain present = re-point a wrong domain before re-running (pre-provisioning
 * only; server rejects once an authentication client exists). Plus tier only - a base whitelabel is
 * re-labelled through PATCH instead.
 */
final readonly class WhitelabelBrandingRecheck implements ApiModel
{
    /**
     * @param string|null $authSubdomain Subdomain the login is served on; required together with hostname
     * @param bool|null $createZone Opt in (or out) of onboarding creating the OpusDNS-hosted zone if it is missing,
     *     applied before this re-run and to any re-pointed domain. Omit to keep the config's current setting - a
     *     plain retry never changes it. Plus tier only.
     * @param string|null $dashboardSubdomain Subdomain the dashboard is served on; omit for apex. Only together with
     *     hostname.
     * @param string|null $hostname New domain to run the whitelabel under; omit to re-run against the stored hosts
     */
    public function __construct(
        public ?string $authSubdomain = null,
        public ?bool $createZone = null,
        public ?string $dashboardSubdomain = null,
        public ?string $hostname = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            authSubdomain: $data['auth_subdomain'] ?? null,
            createZone: $data['create_zone'] ?? null,
            dashboardSubdomain: $data['dashboard_subdomain'] ?? null,
            hostname: $data['hostname'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'auth_subdomain' => $this->authSubdomain,
            'create_zone' => $this->createZone,
            'dashboard_subdomain' => $this->dashboardSubdomain,
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
