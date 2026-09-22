<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DeletePolicyType;
use OpusDNS\Client\Enum\SyncOperationType;
use OpusDNS\Client\Serializer;

final readonly class DomainLifecycleBase implements ApiModel
{
    /**
     * @param string|null $addGracePeriod Add grace period in days after registration in ISO 8601 format (e.g., 5D,
     *     3D)
     * @param string|null $autoRenewBeforeExpiration Time before expiration to auto-renew a domain in ISO 8601 format
     *     (e.g., 5D, -7D)
     * @param Period|null $defaultTransferRenewalPeriod Default period for transfer if no transfer_renewal_period is
     *     specified
     * @param string|null $deleteBeforeExpiration Time before expiration to delete a domain in ISO 8601 format (e.g.,
     *     5D, -7D)
     * @param list<DeletePolicyType|string>|null $deletePolicy How a domain can be deleted
     * @param bool|null $explicitRenew Whether an explicit renewal is possible
     * @param string|null $gracePeriod Grace period after expiration in ISO 8601 format (e.g., 5D, -7D)
     * @param string|null $pendingDelete Pending delete period in ISO 8601 format (e.g., 5D, 10D) after
     *     redemption_period
     * @param string|null $redemptionPeriod Redemption period for domain recovery after grace period in ISO 8601
     *     format (e.g., 5D, -7D)
     * @param list<Period>|null $registrationPeriods List of allowed registration periods (e.g., '1y' or ['1y', '2y',
     *     '5y'])
     * @param bool|null $registryAutoRenew Does the registry enforce auto-renewal
     * @param list<Period>|null $renewalPeriods List of allowed renewal periods (e.g., '1y' or ['1y', '2y', '5y'])
     * @param bool $restoreTriggersRenewal After a restore, renew the domain so its term matches the subscription.
     *     True for RGP registries, whose redemption restore does not extend the domain. False where the restore
     *     already leaves a valid term - e.g. NASK/.pl, where restore removes clientRenewProhibited or
     *     renews+reactivates, and a redundant renew is rejected (one renewal per billing period).
     * @param RgpOperations|null $rgpOperations RGP operations supported by the registry
     * @param list<SyncOperationType|string>|null $syncAfterOperations Operations that trigger a sync with the
     *     registry
     * @param string|null $transferGracePeriod Transfer grace period after a transfer in ISO 8601 format (e.g., 5D,
     *     3D)
     * @param list<Period>|null $transferRenewalPeriods List of allowed transfer renewal periods (eg. '1y')
     */
    public function __construct(
        public ?string $addGracePeriod = null,
        public ?string $autoRenewBeforeExpiration = null,
        public ?Period $defaultTransferRenewalPeriod = null,
        public ?string $deleteBeforeExpiration = null,
        public ?array $deletePolicy = null,
        public ?bool $explicitRenew = null,
        public ?string $gracePeriod = null,
        public ?string $pendingDelete = null,
        public ?string $redemptionPeriod = null,
        public ?array $registrationPeriods = null,
        public ?bool $registryAutoRenew = null,
        public ?array $renewalPeriods = null,
        public bool $restoreTriggersRenewal = true,
        public ?RgpOperations $rgpOperations = null,
        public ?array $syncAfterOperations = null,
        public ?string $transferGracePeriod = null,
        public ?array $transferRenewalPeriods = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            addGracePeriod: $data['add_grace_period'] ?? null,
            autoRenewBeforeExpiration: $data['auto_renew_before_expiration'] ?? null,
            defaultTransferRenewalPeriod: isset($data['default_transfer_renewal_period']) ? Period::fromArray($data['default_transfer_renewal_period']) : null,
            deleteBeforeExpiration: $data['delete_before_expiration'] ?? null,
            deletePolicy: isset($data['delete_policy']) ? array_map(static fn (string $item): DeletePolicyType|string => DeletePolicyType::tryFrom($item) ?? $item, $data['delete_policy']) : null,
            explicitRenew: $data['explicit_renew'] ?? null,
            gracePeriod: $data['grace_period'] ?? null,
            pendingDelete: $data['pending_delete'] ?? null,
            redemptionPeriod: $data['redemption_period'] ?? null,
            registrationPeriods: isset($data['registration_periods']) ? array_map(static fn (array $item): Period => Period::fromArray($item), $data['registration_periods']) : null,
            registryAutoRenew: $data['registry_auto_renew'] ?? null,
            renewalPeriods: isset($data['renewal_periods']) ? array_map(static fn (array $item): Period => Period::fromArray($item), $data['renewal_periods']) : null,
            restoreTriggersRenewal: $data['restore_triggers_renewal'] ?? true,
            rgpOperations: isset($data['rgp_operations']) ? RgpOperations::fromArray($data['rgp_operations']) : null,
            syncAfterOperations: isset($data['sync_after_operations']) ? array_map(static fn (string $item): SyncOperationType|string => SyncOperationType::tryFrom($item) ?? $item, $data['sync_after_operations']) : null,
            transferGracePeriod: $data['transfer_grace_period'] ?? null,
            transferRenewalPeriods: isset($data['transfer_renewal_periods']) ? array_map(static fn (array $item): Period => Period::fromArray($item), $data['transfer_renewal_periods']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'add_grace_period' => $this->addGracePeriod,
            'auto_renew_before_expiration' => $this->autoRenewBeforeExpiration,
            'default_transfer_renewal_period' => $this->defaultTransferRenewalPeriod,
            'delete_before_expiration' => $this->deleteBeforeExpiration,
            'delete_policy' => $this->deletePolicy,
            'explicit_renew' => $this->explicitRenew,
            'grace_period' => $this->gracePeriod,
            'pending_delete' => $this->pendingDelete,
            'redemption_period' => $this->redemptionPeriod,
            'registration_periods' => $this->registrationPeriods,
            'registry_auto_renew' => $this->registryAutoRenew,
            'renewal_periods' => $this->renewalPeriods,
            'restore_triggers_renewal' => $this->restoreTriggersRenewal,
            'rgp_operations' => $this->rgpOperations,
            'sync_after_operations' => $this->syncAfterOperations,
            'transfer_grace_period' => $this->transferGracePeriod,
            'transfer_renewal_periods' => $this->transferRenewalPeriods,
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
