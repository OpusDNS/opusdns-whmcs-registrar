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

final readonly class DomainDnssecDataCreate implements ApiModel
{
    /**
     * @param DnssecAlgorithm|int $algorithm DNSSEC algorithm used
     * @param DnssecRecordType|string $recordType Type of DNSSEC record (DS or Key)
     * @param string|null $digest Digest value for DS records
     * @param DnssecDigestType|int|null $digestType Digest type for DS records
     * @param int|null $flags DNSKEY flags for key records
     * @param int|null $keyTag Key tag for DS records
     * @param int|null $protocol Protocol field for key records (typically 3)
     * @param string|null $publicKey Base64-encoded public key for key records
     */
    public function __construct(
        public DnssecAlgorithm|int $algorithm,
        public DnssecRecordType|string $recordType,
        public ?string $digest = null,
        public DnssecDigestType|int|null $digestType = null,
        public ?int $flags = null,
        public ?int $keyTag = null,
        public ?int $protocol = null,
        public ?string $publicKey = null,
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
            digest: $data['digest'] ?? null,
            digestType: isset($data['digest_type']) ? DnssecDigestType::tryFrom($data['digest_type']) ?? $data['digest_type'] : null,
            flags: $data['flags'] ?? null,
            keyTag: $data['key_tag'] ?? null,
            protocol: $data['protocol'] ?? null,
            publicKey: $data['public_key'] ?? null,
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
            'digest' => $this->digest,
            'digest_type' => $this->digestType,
            'flags' => $this->flags,
            'key_tag' => $this->keyTag,
            'protocol' => $this->protocol,
            'public_key' => $this->publicKey,
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
