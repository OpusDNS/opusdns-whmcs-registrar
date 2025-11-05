<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Enum\PeriodUnit;
use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class Tld
{
    use ModelTrait;


    private bool $enabled = false;
    private array $tlds = [];
    private array $partner_management = [];
    private array $domain_lifecycle = [];
    private array $launch_phases = [];
    private array $domain_statuses = [];
    private array $premium_domains = [];
    private array $reserved_domains = [];
    private array $registry_lock = [];
    private array $characters = [];
    private array $idn = [];
    private array $contacts = [];
    private array $local_presence = [];
    private array $whois = [];
    private array $rdap = [];
    private array $dns_configuration = [];
    private array $dispute_resolutions = [];
    private array $transfer_policies = [];
    private array $required_communications = [];

    public function __construct(array $data = [])
    {
        $this->enabled = isset($data['enabled']) ? (bool)$data['enabled'] : false;
        $this->tlds = isset($data['tlds']) && is_array($data['tlds']) ? $data['tlds'] : [];
        $this->partner_management = isset($data['partner_management']) && is_array($data['partner_management']) ? $data['partner_management'] : [];
        $this->domain_lifecycle = isset($data['domain_lifecycle']) && is_array($data['domain_lifecycle']) ? $data['domain_lifecycle'] : [];
        $this->launch_phases = isset($data['launch_phases']) && is_array($data['launch_phases']) ? $data['launch_phases'] : [];
        $this->domain_statuses = isset($data['domain_statuses']) && is_array($data['domain_statuses']) ? $data['domain_statuses'] : [];
        $this->premium_domains = isset($data['premium_domains']) && is_array($data['premium_domains']) ? $data['premium_domains'] : [];
        $this->reserved_domains = isset($data['reserved_domains']) && is_array($data['reserved_domains']) ? $data['reserved_domains'] : [];
        $this->registry_lock = isset($data['registry_lock']) && is_array($data['registry_lock']) ? $data['registry_lock'] : [];
        $this->characters = isset($data['characters']) && is_array($data['characters']) ? $data['characters'] : [];
        $this->idn = isset($data['idn']) && is_array($data['idn']) ? $data['idn'] : [];
        $this->contacts = isset($data['contacts']) && is_array($data['contacts']) ? $data['contacts'] : [];
        $this->local_presence = isset($data['local_presence']) && is_array($data['local_presence']) ? $data['local_presence'] : [];
        $this->whois = isset($data['whois']) && is_array($data['whois']) ? $data['whois'] : [];
        $this->rdap = isset($data['rdap']) && is_array($data['rdap']) ? $data['rdap'] : [];
        $this->dns_configuration = isset($data['dns_configuration']) && is_array($data['dns_configuration']) ? $data['dns_configuration'] : [];
        $this->dispute_resolutions = isset($data['dispute_resolutions']) && is_array($data['dispute_resolutions']) ? $data['dispute_resolutions'] : [];
        $this->transfer_policies = isset($data['transfer_policies']) && is_array($data['transfer_policies']) ? $data['transfer_policies'] : [];
        $this->required_communications = isset($data['required_communications']) && is_array($data['required_communications']) ? $data['required_communications'] : [];
    }

    public static function extractDaysFromIsoDuration(string $duration): int
    {
        if (preg_match('/P(\d+)D/', $duration, $matches)) {
            return (int)$matches[1];
        }
        return 0;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getTlds(): array
    {
        return $this->tlds;
    }

    public function getPartnerManagement(): array
    {
        return $this->partner_management;
    }

    public function getDomainLifecycle(): array
    {
        return $this->domain_lifecycle;
    }

    public function getLaunchPhases(): array
    {
        return $this->launch_phases;
    }

    public function getDomainStatuses(): array
    {
        return $this->domain_statuses;
    }

    public function getPremiumDomains(): array
    {
        return $this->premium_domains;
    }

    public function getReservedDomains(): array
    {
        return $this->reserved_domains;
    }

    public function getRegistryLock(): array
    {
        return $this->registry_lock;
    }

    public function getCharacters(): array
    {
        return $this->characters;
    }

    public function getIdn(): array
    {
        return $this->idn;
    }

    public function getContacts(): array
    {
        return $this->contacts;
    }

    public function getLocalPresence(): array
    {
        return $this->local_presence;
    }

    public function getWhois(): array
    {
        return $this->whois;
    }

    public function getRdap(): array
    {
        return $this->rdap;
    }

    public function getDnsConfiguration(): array
    {
        return $this->dns_configuration;
    }

    public function getDisputeResolutions(): array
    {
        return $this->dispute_resolutions;
    }

    public function getTransferPolicies(): array
    {
        return $this->transfer_policies;
    }

    public function getRequiredCommunications(): array
    {
        return $this->required_communications;
    }

    public function getGracePeriodDays(): int
    {
        $gracePeriod = $this->domain_lifecycle['grace_period'] ?? 'P0D';
        return self::extractDaysFromIsoDuration($gracePeriod);
    }

    public function getRedemptionPeriodDays(): int
    {
        $redemptionPeriod = $this->domain_lifecycle['redemption_period'] ?? 'P0D';
        return self::extractDaysFromIsoDuration($redemptionPeriod);
    }

    public function getMinRegistrationYears(): int
    {
        $registrationPeriods = $this->domain_lifecycle['registration_periods'] ?? [];

        if (empty($registrationPeriods)) {
            return 1;
        }

        $years = array_map(function ($period) {
            return ($period['unit'] === PeriodUnit::YEAR->value) ? (int)$period['value'] : 0;
        }, $registrationPeriods);

        $years = array_filter($years);

        return !empty($years) ? min($years) : 1;
    }

    public function getMaxRegistrationYears(): int
    {
        $registrationPeriods = $this->domain_lifecycle['registration_periods'] ?? [];

        if (empty($registrationPeriods)) {
            return 1;
        }

        $years = array_map(function ($period) {
            return ($period['unit'] === PeriodUnit::YEAR->value) ? (int)$period['value'] : 0;
        }, $registrationPeriods);

        $years = array_filter($years);

        return !empty($years) ? max($years) : 1;
    }

    public function isAuthInfoRequired(): bool
    {
        return $this->transfer_policies['authinfo_required'] ?? false;
    }

    public function buildContactsArray(string $contactId): array
    {
        $contacts = [];
        $supportedRoles = $this->contacts['supported_roles'] ?? [];

        foreach ($supportedRoles as $role) {
            $type = $role['type'] ?? null;
            $min = $role['min'] ?? 0;

            if ($type && $min > 0) {
                $contacts[$type] = [['contact_id' => $contactId]];
            }
        }

        return $contacts;
    }
}
