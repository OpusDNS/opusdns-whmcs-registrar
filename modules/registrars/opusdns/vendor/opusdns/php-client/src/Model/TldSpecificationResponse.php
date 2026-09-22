<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;
use OpusDNS\Client\Union;

final readonly class TldSpecificationResponse implements ApiModel
{
    /**
     * @param SldLength $characters Character limits for domain names
     * @param DnsConfigurationBase $dnsConfiguration DNS configuration
     * @param DomainLifecycleBase $domainLifecycle Domain lifecycle configuration
     * @param DomainStatusesBase $domainStatuses Domain statuses configuration
     * @param IdnBase $idn IDN configuration
     * @param list<TldBase> $tlds List of TLDs being configured
     * @param TransferPoliciesBase $transferPolicies Transfer policies configuration
     * @param ContactsBase|null $contacts Contacts configuration
     * @param LaunchPhasesBase|null $launchPhases Launch phases configuration
     * @param list<LegalRequirementBase>|null $legalRequirements Legal requirements that must be met for this TLD
     * @param LocalPresenceBase|null $localPresence Local presence requirements
     * @param bool $parkingEnabled Whether parking is enabled for this TLD
     * @param PremiumDomainsBase|null $premiumDomains Premium domains configuration
     * @param RdapBase|null $rdap RDAP configuration
     * @param RegistryLockBase|null $registryLock Registry lock configuration
     * @param ReservedDomainsBase|null $reservedDomains Reserved domains configuration
     * @param array<string, EmailVerificationPolicy|IdentityVerificationPolicy>|null $verificationPolicies Verification Policy Configuration
     * @param WhoisBase|null $whois WHOIS configuration
     */
    public function __construct(
        public SldLength $characters,
        public DnsConfigurationBase $dnsConfiguration,
        public DomainLifecycleBase $domainLifecycle,
        public DomainStatusesBase $domainStatuses,
        public IdnBase $idn,
        public array $tlds,
        public TransferPoliciesBase $transferPolicies,
        public ?ContactsBase $contacts = null,
        public ?LaunchPhasesBase $launchPhases = null,
        public ?array $legalRequirements = null,
        public ?LocalPresenceBase $localPresence = null,
        public bool $parkingEnabled = false,
        public ?PremiumDomainsBase $premiumDomains = null,
        public ?RdapBase $rdap = null,
        public ?RegistryLockBase $registryLock = null,
        public ?ReservedDomainsBase $reservedDomains = null,
        public ?array $verificationPolicies = null,
        public ?WhoisBase $whois = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            characters: SldLength::fromArray($data['characters']),
            dnsConfiguration: DnsConfigurationBase::fromArray($data['dns_configuration']),
            domainLifecycle: DomainLifecycleBase::fromArray($data['domain_lifecycle']),
            domainStatuses: DomainStatusesBase::fromArray($data['domain_statuses']),
            idn: IdnBase::fromArray($data['idn']),
            tlds: array_map(static fn (array $item): TldBase => TldBase::fromArray($item), $data['tlds']),
            transferPolicies: TransferPoliciesBase::fromArray($data['transfer_policies']),
            contacts: isset($data['contacts']) ? ContactsBase::fromArray($data['contacts']) : null,
            launchPhases: isset($data['launch_phases']) ? LaunchPhasesBase::fromArray($data['launch_phases']) : null,
            legalRequirements: isset($data['legal_requirements']) ? array_map(static fn (array $item): LegalRequirementBase => LegalRequirementBase::fromArray($item), $data['legal_requirements']) : null,
            localPresence: isset($data['local_presence']) ? LocalPresenceBase::fromArray($data['local_presence']) : null,
            parkingEnabled: $data['parking_enabled'] ?? false,
            premiumDomains: isset($data['premium_domains']) ? PremiumDomainsBase::fromArray($data['premium_domains']) : null,
            rdap: isset($data['rdap']) ? RdapBase::fromArray($data['rdap']) : null,
            registryLock: isset($data['registry_lock']) ? RegistryLockBase::fromArray($data['registry_lock']) : null,
            reservedDomains: isset($data['reserved_domains']) ? ReservedDomainsBase::fromArray($data['reserved_domains']) : null,
            verificationPolicies: isset($data['verification_policies']) ? array_map(static fn (array $value) => Union::hydrate($value, [EmailVerificationPolicy::class => ['enabled', 'contact_roles', 'trigger', 'validity_period', 'suspension_on_failure', 'suspension_delay', 'verification_method', 'communication'], IdentityVerificationPolicy::class => ['enabled', 'contact_roles', 'trigger', 'validity_period', 'suspension_on_failure', 'suspension_delay', 'required_claims']]), (array) $data['verification_policies']) : null,
            whois: isset($data['whois']) ? WhoisBase::fromArray($data['whois']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'characters' => $this->characters,
            'dns_configuration' => $this->dnsConfiguration,
            'domain_lifecycle' => $this->domainLifecycle,
            'domain_statuses' => $this->domainStatuses,
            'idn' => $this->idn,
            'tlds' => $this->tlds,
            'transfer_policies' => $this->transferPolicies,
            'contacts' => $this->contacts,
            'launch_phases' => $this->launchPhases,
            'legal_requirements' => $this->legalRequirements,
            'local_presence' => $this->localPresence,
            'parking_enabled' => $this->parkingEnabled,
            'premium_domains' => $this->premiumDomains,
            'rdap' => $this->rdap,
            'registry_lock' => $this->registryLock,
            'reserved_domains' => $this->reservedDomains,
            'verification_policies' => $this->verificationPolicies === null ? null : ($this->verificationPolicies === [] ? new \stdClass() : $this->verificationPolicies),
            'whois' => $this->whois,
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
