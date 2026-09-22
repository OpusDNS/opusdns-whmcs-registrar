<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\PostTransferRequirements;
use OpusDNS\Client\Enum\TransferAckType;
use OpusDNS\Client\Serializer;

final readonly class TransferPoliciesBase implements ApiModel
{
    /**
     * @param bool $authinfoRequired Whether an auth info is required for transfers
     * @param TransferLockPolicyBase $transferLockPolicy Transfer lock policy
     * @param int|null $authinfoMaxLength Maximum length of the auth info
     * @param int|null $authinfoMinLength Minimum length of the auth info
     * @param string|null $authinfoPattern Regex pattern for validating auth info
     * @param bool $authinfoSetByRegistrar Whether the registrar can set the auth info, or whether the registry
     *     controls it
     * @param bool|null $authinfoTimeLimited Whether an auth info has a time limit
     * @param string|null $authinfoValidityPeriod Validity period of the auth info (e.g., '5D' for 5 days)
     * @param bool $contactsInTransferCommand Whether the registry takes the domain contacts on the transfer command
     *     itself
     * @param bool|null $infoContactAuthinfo Whether querying a foreign contact with authinfo is possible
     * @param bool|null $infoDomainAuthinfo Whether querying a foreign domain with authinfo is possible
     * @param list<PostTransferRequirements|string>|null $postTransferRequirements Post-transfer requirements: lists the
     *     behaviors, as in ['update_contacts', 'set_transfer_lock'] or [ 'tld_specific' ] for specific behavior
     * @param TransferAckType|string|null $transferAck Whether a transfer can be approved
     * @param bool|null $transferEmailRequired Whether an email confirmation is required to perform the transfer
     * @param TransferAckType|string|null $transferNack Whether a transfer can be denied
     * @param string|null $transferRenewalPeriod If transfer_renews_domain is true, the renewal period (e.g., '1Y'
     *     for 1 year)
     * @param bool|null $transferRenewsDomain Whether a transfer triggers a domain renewal
     * @param string|null $transferTime Time duration of transfers in ISO 8601 format (e.g., 5D, -7D) according to
     *     the policy, 0 = real-time
     */
    public function __construct(
        public bool $authinfoRequired,
        public TransferLockPolicyBase $transferLockPolicy,
        public ?int $authinfoMaxLength = null,
        public ?int $authinfoMinLength = null,
        public ?string $authinfoPattern = null,
        public bool $authinfoSetByRegistrar = true,
        public ?bool $authinfoTimeLimited = null,
        public ?string $authinfoValidityPeriod = null,
        public bool $contactsInTransferCommand = false,
        public ?bool $infoContactAuthinfo = null,
        public ?bool $infoDomainAuthinfo = null,
        public ?array $postTransferRequirements = null,
        public TransferAckType|string|null $transferAck = null,
        public ?bool $transferEmailRequired = null,
        public TransferAckType|string|null $transferNack = null,
        public ?string $transferRenewalPeriod = null,
        public ?bool $transferRenewsDomain = null,
        public ?string $transferTime = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            authinfoRequired: $data['authinfo_required'],
            transferLockPolicy: TransferLockPolicyBase::fromArray($data['transfer_lock_policy']),
            authinfoMaxLength: $data['authinfo_max_length'] ?? null,
            authinfoMinLength: $data['authinfo_min_length'] ?? null,
            authinfoPattern: $data['authinfo_pattern'] ?? null,
            authinfoSetByRegistrar: $data['authinfo_set_by_registrar'] ?? true,
            authinfoTimeLimited: $data['authinfo_time_limited'] ?? null,
            authinfoValidityPeriod: $data['authinfo_validity_period'] ?? null,
            contactsInTransferCommand: $data['contacts_in_transfer_command'] ?? false,
            infoContactAuthinfo: $data['info_contact_authinfo'] ?? null,
            infoDomainAuthinfo: $data['info_domain_authinfo'] ?? null,
            postTransferRequirements: isset($data['post_transfer_requirements']) ? array_map(static fn (string $item): PostTransferRequirements|string => PostTransferRequirements::tryFrom($item) ?? $item, $data['post_transfer_requirements']) : null,
            transferAck: isset($data['transfer_ack']) ? TransferAckType::tryFrom($data['transfer_ack']) ?? $data['transfer_ack'] : null,
            transferEmailRequired: $data['transfer_email_required'] ?? null,
            transferNack: isset($data['transfer_nack']) ? TransferAckType::tryFrom($data['transfer_nack']) ?? $data['transfer_nack'] : null,
            transferRenewalPeriod: $data['transfer_renewal_period'] ?? null,
            transferRenewsDomain: $data['transfer_renews_domain'] ?? null,
            transferTime: $data['transfer_time'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'authinfo_required' => $this->authinfoRequired,
            'transfer_lock_policy' => $this->transferLockPolicy,
            'authinfo_max_length' => $this->authinfoMaxLength,
            'authinfo_min_length' => $this->authinfoMinLength,
            'authinfo_pattern' => $this->authinfoPattern,
            'authinfo_set_by_registrar' => $this->authinfoSetByRegistrar,
            'authinfo_time_limited' => $this->authinfoTimeLimited,
            'authinfo_validity_period' => $this->authinfoValidityPeriod,
            'contacts_in_transfer_command' => $this->contactsInTransferCommand,
            'info_contact_authinfo' => $this->infoContactAuthinfo,
            'info_domain_authinfo' => $this->infoDomainAuthinfo,
            'post_transfer_requirements' => $this->postTransferRequirements,
            'transfer_ack' => $this->transferAck,
            'transfer_email_required' => $this->transferEmailRequired,
            'transfer_nack' => $this->transferNack,
            'transfer_renewal_period' => $this->transferRenewalPeriod,
            'transfer_renews_domain' => $this->transferRenewsDomain,
            'transfer_time' => $this->transferTime,
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
