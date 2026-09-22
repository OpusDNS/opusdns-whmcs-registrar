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
 * Create the plus tier: served on the customer's own domain, with the managed base subdomain composed
 * from `label` served alongside it as a backup address.
 */
final readonly class WhitelabelPlusCreate implements ApiModel
{
    /**
     * @param string $authSubdomain Subdomain the login is served on (e.g. auth -> auth.customer.com)
     * @param string $hostname Domain the whitelabel runs under (e.g. customer.com); an OpusDNS-hosted zone owned by
     *     the org
     * @param string $label Managed-subdomain label; the composed pair is served alongside the custom domain as a
     *     backup
     * @param Period $period Billing period; offered: 1 month or 1 year
     * @param bool $createZone Create the OpusDNS-hosted DNS zone for this domain during onboarding if it does not
     *     already exist, instead of requiring it to exist beforehand. The domain must still be delegated to the
     *     OpusDNS nameservers for verification to pass. The dashboard sends true; other API callers opt in
     *     explicitly.
     * @param string|null $dashboardSubdomain Subdomain the dashboard is served on (e.g. dash -> dash.customer.com);
     *     omit for apex
     * @param string $tier Tier discriminator; plus = served on the customer's own domain
     */
    public function __construct(
        public string $authSubdomain,
        public string $hostname,
        public string $label,
        public Period $period,
        public bool $createZone = false,
        public ?string $dashboardSubdomain = null,
        public string $tier = 'plus',
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
            label: $data['label'],
            period: Period::fromArray($data['period']),
            createZone: $data['create_zone'] ?? false,
            dashboardSubdomain: $data['dashboard_subdomain'] ?? null,
            tier: $data['tier'] ?? 'plus',
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
            'label' => $this->label,
            'period' => $this->period,
            'create_zone' => $this->createZone,
            'dashboard_subdomain' => $this->dashboardSubdomain,
            'tier' => $this->tier,
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
