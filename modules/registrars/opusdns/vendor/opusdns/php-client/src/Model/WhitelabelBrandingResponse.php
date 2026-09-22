<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\WhitelabelBrandingTier;
use OpusDNS\Client\Enum\WhitelabelOnboardingFailureCode;
use OpusDNS\Client\Enum\WhitelabelOnboardingFailureType;
use OpusDNS\Client\Enum\WhitelabelOnboardingStatus;
use OpusDNS\Client\Serializer;

/**
 * Public read shape for an organization's whitelabel branding config.
 */
final readonly class WhitelabelBrandingResponse implements ApiModel
{
    /**
     * @param string $authHostname Auth/login hostname served by the authentication system (e.g. auth.customer.com)
     * @param string $baseLabel Managed-subdomain label; the composed pair is the served pair on base, the backup
     *     pair on plus
     * @param string $hostname Dashboard hostname being served (e.g. app.customer.com)
     * @param WhitelabelOnboardingStatus|string $onboardingStatus Onboarding lifecycle state
     * @param string $organizationId TypeID prefix: organization.
     * @param WhitelabelBrandingTier|string $tier Tier this config is on: base (managed subdomain) or plus
     *     (customer's own domain)
     * @param string $verificationDomain Registrable domain of the served hostname
     * @param string $whitelabelBrandingId TypeID prefix: wlb.
     * @param string|null $baseAuthHostname Managed base auth host (auth.<base_label>.<suffix>); null until first
     *     published
     * @param string|null $baseHostname Managed base dashboard host (app.<base_label>.<suffix>); on plus a backup
     *     address served alongside the custom domain, null until first published
     * @param bool $enabled Whether this whitelabel is served; false freezes serving but keeps the config
     * @param WhitelabelOnboardingFailureCode|string|null $failureCode Stable code of the last terminal onboarding
     *     failure
     * @param string|null $failureDetail Free-text detail of the last onboarding failure (support/debugging, not for
     *     customer display)
     * @param string|null $keycloakClientId Authentication-system client provisioned for this whitelabel; null until
     *     provisioning
     * @param WhitelabelSubscriptionInfo|null $subscription Billing-lifecycle block; null when the config has no live
     *     subscription (provisioning or terminated)
     */
    public function __construct(
        public string $authHostname,
        public string $baseLabel,
        public \DateTimeImmutable $createdOn,
        public string $hostname,
        public WhitelabelOnboardingStatus|string $onboardingStatus,
        public string $organizationId,
        public WhitelabelBrandingTier|string $tier,
        public \DateTimeImmutable $updatedOn,
        public string $verificationDomain,
        public string $whitelabelBrandingId,
        public ?string $baseAuthHostname = null,
        public ?string $baseHostname = null,
        public bool $enabled = true,
        public WhitelabelOnboardingFailureCode|string|null $failureCode = null,
        public ?string $failureDetail = null,
        public WhitelabelOnboardingFailureType|string|null $failureType = null,
        public ?string $keycloakClientId = null,
        public ?WhitelabelSubscriptionInfo $subscription = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            authHostname: $data['auth_hostname'],
            baseLabel: $data['base_label'],
            createdOn: new \DateTimeImmutable($data['created_on']),
            hostname: $data['hostname'],
            onboardingStatus: WhitelabelOnboardingStatus::tryFrom($data['onboarding_status']) ?? $data['onboarding_status'],
            organizationId: $data['organization_id'],
            tier: WhitelabelBrandingTier::tryFrom($data['tier']) ?? $data['tier'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            verificationDomain: $data['verification_domain'],
            whitelabelBrandingId: $data['whitelabel_branding_id'],
            baseAuthHostname: $data['base_auth_hostname'] ?? null,
            baseHostname: $data['base_hostname'] ?? null,
            enabled: $data['enabled'] ?? true,
            failureCode: isset($data['failure_code']) ? WhitelabelOnboardingFailureCode::tryFrom($data['failure_code']) ?? $data['failure_code'] : null,
            failureDetail: $data['failure_detail'] ?? null,
            failureType: isset($data['failure_type']) ? WhitelabelOnboardingFailureType::tryFrom($data['failure_type']) ?? $data['failure_type'] : null,
            keycloakClientId: $data['keycloak_client_id'] ?? null,
            subscription: isset($data['subscription']) ? WhitelabelSubscriptionInfo::fromArray($data['subscription']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'auth_hostname' => $this->authHostname,
            'base_label' => $this->baseLabel,
            'created_on' => $this->createdOn,
            'hostname' => $this->hostname,
            'onboarding_status' => $this->onboardingStatus,
            'organization_id' => $this->organizationId,
            'tier' => $this->tier,
            'updated_on' => $this->updatedOn,
            'verification_domain' => $this->verificationDomain,
            'whitelabel_branding_id' => $this->whitelabelBrandingId,
            'base_auth_hostname' => $this->baseAuthHostname,
            'base_hostname' => $this->baseHostname,
            'enabled' => $this->enabled,
            'failure_code' => $this->failureCode,
            'failure_detail' => $this->failureDetail,
            'failure_type' => $this->failureType,
            'keycloak_client_id' => $this->keycloakClientId,
            'subscription' => $this->subscription,
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
