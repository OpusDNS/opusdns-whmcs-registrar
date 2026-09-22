<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\RenewalMode;
use OpusDNS\Client\Serializer;

final readonly class DomainResponse implements ApiModel
{
    /**
     * @param string $name The domain name
     * @param string $roid The registry object id of the domain
     * @param string $sld The second level domain
     * @param string $tld The top level domain of the domain
     * @param string|null $authCode The auth code for the domain
     * @param \DateTimeImmutable|null $authCodeExpiresOn When the auth code expires
     * @param \DateTimeImmutable|null $canceledOn When the domain was deleted
     * @param list<DomainContactResponse>|null $contacts The contacts of the domain
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param \DateTimeImmutable|null $deletedOn When the domain will be deleted
     * @param string|null $domainId TypeID prefix: domain.
     * @param \DateTimeImmutable|null $expiresOn When the domain expires
     * @param list<DomainHostResponse>|null $hosts The subordinate hosts of the domain
     * @param bool $isPremium Whether the registry prices this domain at a premium class for the action it was bought
     *     under. Not purchase provenance: a renewal-time check that affirmatively quotes renew as standard corrects
     *     the flag, so it tracks the registry's current classification. Registries classify each action separately,
     *     so a domain premium only to restore is not premium here.
     * @param list<Nameserver>|null $nameservers The nameservers of the domain
     * @param string|null $ownerId The organization that owns the domain TypeID prefix: organization.
     * @param bool $readOnly Whether the domain is read-only in OpusDNS. When `true`, the domain is listed in your
     *     portfolio but cannot be managed — for example while it awaits a migration, is locked for legal reasons,
     *     or is managed at an external registrar. The flag is set and removed by OpusDNS; it cannot be changed
     *     through the API.
     * @param \DateTimeImmutable|null $registeredOn When the domain was registered
     * @param DomainRegistrarCredentialResponse|null $registrarCredential The connected registrar credential this
     *     domain is synced from. Null unless `include=registrar_credential` is requested, and null even then for
     *     natively registered domains, for domains on operator-managed registry accounts, and when the credential
     *     was deleted.
     * @param string|null $registryAccountId TypeID prefix: registry_account.
     * @param list<string>|null $registryStatuses All the domain statuses
     * @param RenewalMode|string|null $renewalMode The renewal mode of the domain
     * @param string|null $renewalPeriod Renewal period of the domain as an ISO 8601 duration (e.g. 'P1M', 'P1Y').
     *     Null when the domain is not set to renew (renewal mode 'expire') or has no active subscription.
     * @param DomainRenewalPriceResponse|null $renewalPrice Price this organization pays to renew this domain for one
     *     year. Only included when ?include=renewal_price is specified.
     * @param list<StatusTagResponse>|null $statusTags Status tags assigned to this domain. Null unless
     *     `include=tags` is requested.
     * @param list<TagEnrichedResponse>|null $tags User tags assigned to this domain. Null unless `include=tags` is
     *     requested.
     * @param bool $transferLock Whether the domain is locked for transfer
     * @param \DateTimeImmutable|null $transferredOn When the domain was last transferred to us
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     * @param VerificationResponse|null $verificationRequired Verification data for this domain, including pending
     *     claims and deadlines.
     */
    public function __construct(
        public string $name,
        public string $roid,
        public string $sld,
        public string $tld,
        public ?string $authCode = null,
        public ?\DateTimeImmutable $authCodeExpiresOn = null,
        public ?\DateTimeImmutable $canceledOn = null,
        public ?array $contacts = null,
        public ?\DateTimeImmutable $createdOn = null,
        public ?\DateTimeImmutable $deletedOn = null,
        public ?string $domainId = null,
        public ?\DateTimeImmutable $expiresOn = null,
        public ?array $hosts = null,
        public bool $isPremium = false,
        public ?array $nameservers = null,
        public ?string $ownerId = null,
        public bool $readOnly = false,
        public ?\DateTimeImmutable $registeredOn = null,
        public ?DomainRegistrarCredentialResponse $registrarCredential = null,
        public ?string $registryAccountId = null,
        public ?array $registryStatuses = null,
        public RenewalMode|string|null $renewalMode = null,
        public ?string $renewalPeriod = null,
        public ?DomainRenewalPriceResponse $renewalPrice = null,
        public ?array $statusTags = null,
        public ?array $tags = null,
        public bool $transferLock = false,
        public ?\DateTimeImmutable $transferredOn = null,
        public ?\DateTimeImmutable $updatedOn = null,
        public ?VerificationResponse $verificationRequired = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            roid: $data['roid'],
            sld: $data['sld'],
            tld: $data['tld'],
            authCode: $data['auth_code'] ?? null,
            authCodeExpiresOn: isset($data['auth_code_expires_on']) ? new \DateTimeImmutable($data['auth_code_expires_on']) : null,
            canceledOn: isset($data['canceled_on']) ? new \DateTimeImmutable($data['canceled_on']) : null,
            contacts: isset($data['contacts']) ? array_map(static fn (array $item): DomainContactResponse => DomainContactResponse::fromArray($item), $data['contacts']) : null,
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            deletedOn: isset($data['deleted_on']) ? new \DateTimeImmutable($data['deleted_on']) : null,
            domainId: $data['domain_id'] ?? null,
            expiresOn: isset($data['expires_on']) ? new \DateTimeImmutable($data['expires_on']) : null,
            hosts: isset($data['hosts']) ? array_map(static fn (array $item): DomainHostResponse => DomainHostResponse::fromArray($item), $data['hosts']) : null,
            isPremium: $data['is_premium'] ?? false,
            nameservers: isset($data['nameservers']) ? array_map(static fn (array $item): Nameserver => Nameserver::fromArray($item), $data['nameservers']) : null,
            ownerId: $data['owner_id'] ?? null,
            readOnly: $data['read_only'] ?? false,
            registeredOn: isset($data['registered_on']) ? new \DateTimeImmutable($data['registered_on']) : null,
            registrarCredential: isset($data['registrar_credential']) ? DomainRegistrarCredentialResponse::fromArray($data['registrar_credential']) : null,
            registryAccountId: $data['registry_account_id'] ?? null,
            registryStatuses: $data['registry_statuses'] ?? null,
            renewalMode: isset($data['renewal_mode']) ? RenewalMode::tryFrom($data['renewal_mode']) ?? $data['renewal_mode'] : null,
            renewalPeriod: $data['renewal_period'] ?? null,
            renewalPrice: isset($data['renewal_price']) ? DomainRenewalPriceResponse::fromArray($data['renewal_price']) : null,
            statusTags: isset($data['status_tags']) ? array_map(static fn (array $item): StatusTagResponse => StatusTagResponse::fromArray($item), $data['status_tags']) : null,
            tags: isset($data['tags']) ? array_map(static fn (array $item): TagEnrichedResponse => TagEnrichedResponse::fromArray($item), $data['tags']) : null,
            transferLock: $data['transfer_lock'] ?? false,
            transferredOn: isset($data['transferred_on']) ? new \DateTimeImmutable($data['transferred_on']) : null,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
            verificationRequired: isset($data['verification_required']) ? VerificationResponse::fromArray($data['verification_required']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'roid' => $this->roid,
            'sld' => $this->sld,
            'tld' => $this->tld,
            'auth_code' => $this->authCode,
            'auth_code_expires_on' => $this->authCodeExpiresOn,
            'canceled_on' => $this->canceledOn,
            'contacts' => $this->contacts,
            'created_on' => $this->createdOn,
            'deleted_on' => $this->deletedOn,
            'domain_id' => $this->domainId,
            'expires_on' => $this->expiresOn,
            'hosts' => $this->hosts,
            'is_premium' => $this->isPremium,
            'nameservers' => $this->nameservers,
            'owner_id' => $this->ownerId,
            'read_only' => $this->readOnly,
            'registered_on' => $this->registeredOn,
            'registrar_credential' => $this->registrarCredential,
            'registry_account_id' => $this->registryAccountId,
            'registry_statuses' => $this->registryStatuses,
            'renewal_mode' => $this->renewalMode,
            'renewal_period' => $this->renewalPeriod,
            'renewal_price' => $this->renewalPrice,
            'status_tags' => $this->statusTags,
            'tags' => $this->tags,
            'transfer_lock' => $this->transferLock,
            'transferred_on' => $this->transferredOn,
            'updated_on' => $this->updatedOn,
            'verification_required' => $this->verificationRequired,
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
