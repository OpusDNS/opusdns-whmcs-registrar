<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use BackedEnum;
use OpusDNS\Client\Client;
use OpusDNS\Client\Enum\DnssecAlgorithm;
use OpusDNS\Client\Enum\DnssecDigestType;
use OpusDNS\Client\Enum\DnssecRecordType;
use OpusDNS\Client\Model\DomainDnssecDataCreate;
use OpusDNS\Client\Model\DomainDnssecDataResponse;

/**
 * Reads, adds and removes the DNSSEC records of a domain.
 */
class Dnssec
{
    public const DEFAULT_PROTOCOL = 3;
    public const DEFAULT_ALGORITHM = 13;
    public const DEFAULT_DIGEST_TYPE = 2;
    public const DEFAULT_FLAGS = 257;

    private const ALGORITHM_NAMES = [
        1 => 'RSAMD5',
        2 => 'DH',
        3 => 'DSA',
        4 => 'ECC',
        5 => 'RSASHA1',
        6 => 'DSA-NSEC3-SHA1',
        7 => 'RSASHA1-NSEC3-SHA1',
        8 => 'RSASHA256',
        10 => 'RSASHA512',
        12 => 'ECC-GOST',
        13 => 'ECDSAP256SHA256',
        14 => 'ECDSAP384SHA384',
        15 => 'ED25519',
        16 => 'ED448',
        17 => 'SM2SM3',
        23 => 'ECC-GOST12',
    ];

    private const DIGEST_TYPE_NAMES = [
        1 => 'SHA-1',
        2 => 'SHA-256',
        3 => 'GOST R 34.11-94',
        4 => 'SHA-384',
        5 => 'GOST R 34.11-2012',
        6 => 'SM3',
    ];

    private const DIGEST_HEX_LENGTHS = [
        1 => 40,
        2 => 64,
        3 => 64,
        4 => 96,
        5 => 64,
        6 => 64,
    ];

    private const KEY_ROLES = [
        256 => 'ZSK',
        257 => 'KSK',
    ];

    private const MAX_UINT8 = 255;
    private const MAX_UINT16 = 65535;

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * Returns the domain's DNSSEC records for the template.
     *
     * @return list<array<string, mixed>>
     */
    public function records(string $domainName): array
    {
        return array_map(self::toTemplateArray(...), $this->client->domain()->getDnssec($domainName));
    }

    /**
     * Adds the posted record. Returns false when the domain already has it.
     *
     * @param array<string, mixed> $formData
     */
    public function addRecordFromFormData(string $domainName, array $formData, DnssecRecordType $recordType): bool
    {
        $newRecord = self::fromFormData($formData, $recordType);
        $records = array_map(self::toCreate(...), $this->client->domain()->getDnssec($domainName));

        foreach ($records as $existingRecord) {
            if (self::comparableArray($existingRecord) === self::comparableArray($newRecord)) {
                return false;
            }
        }

        $records[] = $newRecord;
        $this->client->domain()->createOrUpdateDnssec($domainName, $records);

        return true;
    }

    /**
     * Removes the record with the given id. Returns false when the domain has no such record.
     */
    public function removeRecord(string $domainName, string $recordId): bool
    {
        $records = $this->client->domain()->getDnssec($domainName);
        $remainingRecords = array_values(array_filter(
            $records,
            static fn (DomainDnssecDataResponse $record): bool => $record->domainDnssecDataId !== $recordId,
        ));

        if (count($remainingRecords) === count($records)) {
            return false;
        }

        if ($remainingRecords === []) {
            $this->client->domain()->deleteDnssec($domainName);

            return true;
        }

        $this->client->domain()->createOrUpdateDnssec($domainName, array_map(self::toCreate(...), $remainingRecords));

        return true;
    }

    /**
     * Returns the first invalid form field, or null when the form is valid.
     *
     * @param array<string, mixed> $formData
     */
    public static function invalidField(array $formData, DnssecRecordType $recordType): ?string
    {
        $algorithm = self::parseUint16($formData['algorithm'] ?? null);
        $algorithmIsValid = $algorithm !== null && DnssecAlgorithm::tryFrom($algorithm) !== null;

        if ($recordType === DnssecRecordType::KEY_DATA) {
            if (self::parseUint16($formData['flags'] ?? null) === null) {
                return 'flags';
            }

            $protocol = self::parseUint16($formData['protocol'] ?? null);
            if ($protocol === null || $protocol > self::MAX_UINT8) {
                return 'protocol';
            }

            if (!$algorithmIsValid) {
                return 'algorithm';
            }

            $publicKey = self::normalizePublicKey($formData['public_key'] ?? null);
            if ($publicKey === '' || base64_decode($publicKey, true) === false) {
                return 'public_key';
            }

            return null;
        }

        if (self::parseUint16($formData['key_tag'] ?? null) === null) {
            return 'key_tag';
        }

        if (!$algorithmIsValid) {
            return 'algorithm';
        }

        $digestType = self::parseUint16($formData['digest_type'] ?? null);
        if ($digestType === null || DnssecDigestType::tryFrom($digestType) === null) {
            return 'digest_type';
        }

        $digest = self::normalizeDigest($formData['digest'] ?? null);
        $expectedLength = self::DIGEST_HEX_LENGTHS[$digestType] ?? null;
        if (!ctype_xdigit($digest) || ($expectedLength !== null && strlen($digest) !== $expectedLength)) {
            return 'digest';
        }

        return null;
    }

    /**
     * Returns the algorithm select options.
     *
     * @return array<int, string>
     */
    public static function algorithmOptions(): array
    {
        $options = [];

        foreach (DnssecAlgorithm::cases() as $algorithm) {
            $options[$algorithm->value] = self::algorithmLabel($algorithm->value);
        }

        return $options;
    }

    /**
     * Returns the digest type select options.
     *
     * @return array<int, string>
     */
    public static function digestTypeOptions(): array
    {
        $options = [];

        foreach (DnssecDigestType::cases() as $digestType) {
            $options[$digestType->value] = self::digestTypeLabel($digestType->value);
        }

        return $options;
    }

    private static function algorithmLabel(int $algorithm): string
    {
        $name = self::ALGORITHM_NAMES[$algorithm] ?? null;

        return $name === null ? (string) $algorithm : "{$algorithm} - {$name}";
    }

    private static function digestTypeLabel(int $digestType): string
    {
        $name = self::DIGEST_TYPE_NAMES[$digestType] ?? null;

        return $name === null ? (string) $digestType : "{$digestType} - {$name}";
    }

    /**
     * @return array<string, mixed>
     */
    private static function toTemplateArray(DomainDnssecDataResponse $record): array
    {
        $algorithm = self::intValue($record->algorithm);
        $digestType = $record->digestType === null ? null : self::intValue($record->digestType);

        return [
            'id' => $record->domainDnssecDataId,
            'key_tag' => $record->keyTag,
            'algorithm' => $algorithm,
            'algorithm_name' => self::ALGORITHM_NAMES[$algorithm] ?? null,
            'digest_type' => $digestType,
            'digest_type_name' => $digestType === null ? null : self::DIGEST_TYPE_NAMES[$digestType] ?? null,
            'digest' => $record->digest,
            'flags' => $record->flags,
            'protocol' => $record->protocol,
            'key_role' => $record->flags === null ? null : self::KEY_ROLES[$record->flags] ?? null,
            'public_key' => $record->publicKey,
        ];
    }

    private static function toCreate(DomainDnssecDataResponse $record): DomainDnssecDataCreate
    {
        return new DomainDnssecDataCreate(
            algorithm: $record->algorithm,
            recordType: $record->recordType,
            digest: $record->digest,
            digestType: $record->digestType,
            flags: $record->flags,
            keyTag: $record->keyTag,
            protocol: $record->protocol,
            publicKey: $record->publicKey,
        );
    }

    /**
     * @param array<string, mixed> $formData
     */
    private static function fromFormData(array $formData, DnssecRecordType $recordType): DomainDnssecDataCreate
    {
        $algorithm = DnssecAlgorithm::from((int) $formData['algorithm']);

        if ($recordType === DnssecRecordType::KEY_DATA) {
            return new DomainDnssecDataCreate(
                algorithm: $algorithm,
                recordType: $recordType,
                flags: (int) $formData['flags'],
                protocol: (int) $formData['protocol'],
                publicKey: self::normalizePublicKey($formData['public_key']),
            );
        }

        return new DomainDnssecDataCreate(
            algorithm: $algorithm,
            recordType: $recordType,
            digest: self::normalizeDigest($formData['digest']),
            digestType: DnssecDigestType::from((int) $formData['digest_type']),
            keyTag: (int) $formData['key_tag'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    private static function comparableArray(DomainDnssecDataCreate $record): array
    {
        $values = $record->toArray();

        if ($record->recordType === DnssecRecordType::KEY_DATA) {
            unset($values['key_tag']);
        }

        if (isset($values['digest'])) {
            $values['digest'] = self::normalizeDigest($values['digest']);
        }

        if (isset($values['public_key'])) {
            $values['public_key'] = self::normalizePublicKey($values['public_key']);
        }

        ksort($values);

        return $values;
    }

    private static function parseUint16(mixed $value): ?int
    {
        $text = trim((string) $value);

        if ($text === '' || !ctype_digit($text) || (int) $text > self::MAX_UINT16) {
            return null;
        }

        return (int) $text;
    }

    private static function normalizeDigest(mixed $digest): string
    {
        return strtoupper((string) preg_replace('/\s+/', '', (string) $digest));
    }

    private static function normalizePublicKey(mixed $publicKey): string
    {
        return (string) preg_replace('/\s+/', '', (string) $publicKey);
    }

    private static function intValue(BackedEnum|int $value): int
    {
        return $value instanceof BackedEnum ? (int) $value->value : $value;
    }
}
