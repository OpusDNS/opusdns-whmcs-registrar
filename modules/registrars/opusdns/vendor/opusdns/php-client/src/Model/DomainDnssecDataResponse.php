<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DnssecAlgorithm;
use OpusDNS\Client\Enum\DnssecDigestType;
use OpusDNS\Client\Enum\DnssecRecordType;
use OpusDNS\Client\Serializer;

final readonly class DomainDnssecDataResponse implements ApiModel
{
    /**
     * @param DnssecAlgorithm|int $algorithm DNSSEC algorithm used
     * @param DnssecRecordType|string $recordType Type of DNSSEC record (DS or Key)
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param string|null $digest Digest value for DS records
     * @param DnssecDigestType|int|null $digestType Digest type for DS records
     * @param string|null $domainDnssecDataId TypeID prefix: domain_dnssec.
     * @param string|null $domainId The domain this DNSSEC record belongs to TypeID prefix: domain.
     * @param int|null $flags DNSKEY flags for key records
     * @param int|null $keyTag Key tag for DS records
     * @param int|null $protocol Protocol field for key records (typically 3)
     * @param string|null $publicKey Base64-encoded public key for key records
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     */
    public function __construct(
        public DnssecAlgorithm|int $algorithm,
        public DnssecRecordType|string $recordType,
        public ?\DateTimeImmutable $createdOn = null,
        public ?string $digest = null,
        public DnssecDigestType|int|null $digestType = null,
        public ?string $domainDnssecDataId = null,
        public ?string $domainId = null,
        public ?int $flags = null,
        public ?int $keyTag = null,
        public ?int $protocol = null,
        public ?string $publicKey = null,
        public ?\DateTimeImmutable $updatedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            algorithm: DnssecAlgorithm::tryFrom($data['algorithm']) ?? $data['algorithm'],
            recordType: DnssecRecordType::tryFrom($data['record_type']) ?? $data['record_type'],
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            digest: $data['digest'] ?? null,
            digestType: isset($data['digest_type']) ? DnssecDigestType::tryFrom($data['digest_type']) ?? $data['digest_type'] : null,
            domainDnssecDataId: $data['domain_dnssec_data_id'] ?? null,
            domainId: $data['domain_id'] ?? null,
            flags: $data['flags'] ?? null,
            keyTag: $data['key_tag'] ?? null,
            protocol: $data['protocol'] ?? null,
            publicKey: $data['public_key'] ?? null,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'algorithm' => $this->algorithm,
            'record_type' => $this->recordType,
            'created_on' => $this->createdOn,
            'digest' => $this->digest,
            'digest_type' => $this->digestType,
            'domain_dnssec_data_id' => $this->domainDnssecDataId,
            'domain_id' => $this->domainId,
            'flags' => $this->flags,
            'key_tag' => $this->keyTag,
            'protocol' => $this->protocol,
            'public_key' => $this->publicKey,
            'updated_on' => $this->updatedOn,
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
