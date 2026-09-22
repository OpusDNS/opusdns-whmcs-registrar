<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\RenewalModeDTO;
use OpusDNS\Client\Enum\VanityNameserverSetStatusDTO;
use OpusDNS\Client\Serializer;

/**
 * Status-aware variant of `VanityNameserverSetDTO` for list/get endpoints. `VanityNameserverSetDTO`
 * stays the brandable-only read shape (always ACTIVE).
 */
final readonly class VanityNameserverSetSummaryDTO implements ApiModel
{
    /**
     * @param bool $isDefault Whether this is the org's default vanity NS set
     * @param string $name Human-readable name for the vanity NS set
     * @param string $organizationId Owning organization TypeID prefix: organization.
     * @param string $parentDomainName Parent domain used as the apex of the vanity NS zone
     * @param string $setId Stable identifier for the vanity NS set TypeID prefix: vns.
     * @param string $soaRname SOA RNAME used verbatim when creating vanity-branded zones
     * @param VanityNameserverSetStatusDTO|string $status Lifecycle status of the set
     * @param \DateTimeImmutable|null $expiresOn When the vanity nameserver set's current service period ends (renews
     *     or lapses)
     * @param \DateTimeImmutable|null $gracePeriodEndsAt When the grace period ends, or null when the set is not in a
     *     grace period
     * @param list<VanityNameserverDTO>|null $nameservers Nameservers in the set, ordered by position
     * @param \DateTimeImmutable|null $renewScheduledAt When the next automatic renewal is scheduled. Null when the
     *     set will not renew.
     * @param RenewalModeDTO|string|null $renewalMode Whether the set is set to renew or expire at the end of the
     *     current period
     */
    public function __construct(
        public bool $isDefault,
        public string $name,
        public string $organizationId,
        public string $parentDomainName,
        public string $setId,
        public string $soaRname,
        public VanityNameserverSetStatusDTO|string $status,
        public ?\DateTimeImmutable $expiresOn = null,
        public ?\DateTimeImmutable $gracePeriodEndsAt = null,
        public ?array $nameservers = null,
        public ?\DateTimeImmutable $renewScheduledAt = null,
        public RenewalModeDTO|string|null $renewalMode = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            isDefault: $data['is_default'],
            name: $data['name'],
            organizationId: $data['organization_id'],
            parentDomainName: $data['parent_domain_name'],
            setId: $data['set_id'],
            soaRname: $data['soa_rname'],
            status: VanityNameserverSetStatusDTO::tryFrom($data['status']) ?? $data['status'],
            expiresOn: isset($data['expires_on']) ? new \DateTimeImmutable($data['expires_on']) : null,
            gracePeriodEndsAt: isset($data['grace_period_ends_at']) ? new \DateTimeImmutable($data['grace_period_ends_at']) : null,
            nameservers: isset($data['nameservers']) ? array_map(static fn (array $item): VanityNameserverDTO => VanityNameserverDTO::fromArray($item), $data['nameservers']) : null,
            renewScheduledAt: isset($data['renew_scheduled_at']) ? new \DateTimeImmutable($data['renew_scheduled_at']) : null,
            renewalMode: isset($data['renewal_mode']) ? RenewalModeDTO::tryFrom($data['renewal_mode']) ?? $data['renewal_mode'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'is_default' => $this->isDefault,
            'name' => $this->name,
            'organization_id' => $this->organizationId,
            'parent_domain_name' => $this->parentDomainName,
            'set_id' => $this->setId,
            'soa_rname' => $this->soaRname,
            'status' => $this->status,
            'expires_on' => $this->expiresOn,
            'grace_period_ends_at' => $this->gracePeriodEndsAt,
            'nameservers' => $this->nameservers,
            'renew_scheduled_at' => $this->renewScheduledAt,
            'renewal_mode' => $this->renewalMode,
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
