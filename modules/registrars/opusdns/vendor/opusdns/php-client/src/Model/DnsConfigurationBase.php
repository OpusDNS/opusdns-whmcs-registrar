<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnssecModeType;
use OpusDNS\Client\Serializer;

final readonly class DnsConfigurationBase implements ApiModel
{
    /**
     * @param bool $dnssecAllowed Whether the registry supports DNSSEC
     * @param bool $hostObjects Whether the registry supports host objects or use attributes
     * @param bool $registryNameserverCheck Whether the registry checks the nameserver configuration
     * @param int $registryRootNameserverUpdate Number of hours until the root zone is updated, 0 = real-time
     * @param bool|null $czdsAvailable Whether the zone is available in CZDS
     * @param bool|null $dnssecMandatory Whether DNSSEC is mandatory for a domain name
     * @param DnssecModeType|string|null $dnssecMode DNSSEC mode
     * @param list<int>|null $dnssecSubmitDigestTypes Which DS digest types we submit to the registry for zones we
     *     host, in order of preference: the first listed type the zone has a DS record for is submitted, later
     *     entries are fallbacks. Absent means submit every digest type the zone publishes. This is our submission
     *     policy, not the set of digest types the registry accepts.
     * @param list<string>|null $hostParentCheckTlds TLDs that require parent-host checks (ns1.example.com =>
     *     example.com)
     */
    public function __construct(
        public AllowedNumberOfNameserverBase $allowedNumberOfNameserver,
        public bool $dnssecAllowed,
        public bool $hostObjects,
        public bool $registryNameserverCheck,
        public int $registryRootNameserverUpdate,
        public ?bool $czdsAvailable = null,
        public ?bool $dnssecMandatory = null,
        public DnssecModeType|string|null $dnssecMode = null,
        public ?array $dnssecSubmitDigestTypes = null,
        public ?array $hostParentCheckTlds = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            allowedNumberOfNameserver: AllowedNumberOfNameserverBase::fromArray($data['allowed_number_of_nameserver']),
            dnssecAllowed: $data['dnssec_allowed'],
            hostObjects: $data['host_objects'],
            registryNameserverCheck: $data['registry_nameserver_check'],
            registryRootNameserverUpdate: $data['registry_root_nameserver_update'],
            czdsAvailable: $data['czds_available'] ?? null,
            dnssecMandatory: $data['dnssec_mandatory'] ?? null,
            dnssecMode: isset($data['dnssec_mode']) ? DnssecModeType::tryFrom($data['dnssec_mode']) ?? $data['dnssec_mode'] : null,
            dnssecSubmitDigestTypes: $data['dnssec_submit_digest_types'] ?? null,
            hostParentCheckTlds: $data['host_parent_check_tlds'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'allowed_number_of_nameserver' => $this->allowedNumberOfNameserver,
            'dnssec_allowed' => $this->dnssecAllowed,
            'host_objects' => $this->hostObjects,
            'registry_nameserver_check' => $this->registryNameserverCheck,
            'registry_root_nameserver_update' => $this->registryRootNameserverUpdate,
            'czds_available' => $this->czdsAvailable,
            'dnssec_mandatory' => $this->dnssecMandatory,
            'dnssec_mode' => $this->dnssecMode,
            'dnssec_submit_digest_types' => $this->dnssecSubmitDigestTypes,
            'host_parent_check_tlds' => $this->hostParentCheckTlds,
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
