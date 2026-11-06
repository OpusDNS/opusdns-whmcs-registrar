<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use InvalidArgumentException;
use OpusDNS\Client\Client;
use OpusDNS\Client\Enum\DnsRrsetType;
use OpusDNS\Client\Enum\PatchOp;
use OpusDNS\Client\Model\DnsRecordCreate;
use OpusDNS\Client\Model\DnsRecordPatchOp;
use OpusDNS\Client\Model\DnsRrsetPatch;
use OpusDNS\Client\Model\DnsRrsetPatchOp;
use OpusDNS\Client\Model\DnsRrsetWithOneRecordPatch;
use OpusDNS\Client\Model\DnsZoneRecordsPatchOps;
use OpusDNS\Client\Model\DnsZoneRrsetsPatchOps;
use WHMCS\Module\Registrar\OpusDNS\Helper\DnsZoneHelper;
use WHMCS\Module\Registrar\OpusDNS\Helper\TxtRecordHelper;

/**
 * Validates the record sets of the DNS zone page, turns them into patch operations and sends them.
 *
 * A record set is an array with name, type, ttl and records, the records each a string or an array with rdata. Its
 * name must be inside the zone and its type one that customers may edit.
 */
class Dns
{
    public const DEFAULT_TTL = 3600;

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * Adds the records to their record set, keeping the records already in it.
     */
    public function addRecords(string $zoneName, mixed $rrset): void
    {
        [$name, $type, $ttl] = self::parseRrset($zoneName, $rrset);

        $ops = array_map(
            static fn (string $rdata): DnsRecordPatchOp => new DnsRecordPatchOp(
                PatchOp::UPSERT,
                new DnsRrsetWithOneRecordPatch($name, $rdata, $ttl, $type),
            ),
            self::rdataValues($rrset['records'] ?? [], $type),
        );

        $this->client->dns()->patchZoneRecords($zoneName, new DnsZoneRecordsPatchOps($ops));
    }

    /**
     * @param array<mixed> $rrsets
     */
    public function upsertRrsets(string $zoneName, array $rrsets): void
    {
        $ops = array_map(static fn (mixed $rrset): DnsRrsetPatchOp => self::upsertOp($zoneName, $rrset), $rrsets);

        $this->patchRrsets($zoneName, $ops);
    }

    /**
     * @param array<mixed> $rrsets
     */
    public function deleteRrsets(string $zoneName, array $rrsets): void
    {
        $ops = array_map(static fn (mixed $rrset): DnsRrsetPatchOp => self::removeOp($zoneName, $rrset), $rrsets);

        $this->patchRrsets($zoneName, $ops);
    }

    /**
     * @param array<DnsRrsetPatchOp> $ops
     */
    private function patchRrsets(string $zoneName, array $ops): void
    {
        $this->client->dns()->patchZoneRrsets($zoneName, new DnsZoneRrsetsPatchOps(array_values($ops)));
    }

    private static function upsertOp(string $zoneName, mixed $rrset): DnsRrsetPatchOp
    {
        [$name, $type, $ttl] = self::parseRrset($zoneName, $rrset);
        $records = array_map(
            static fn (string $rdata): DnsRecordCreate => new DnsRecordCreate($rdata),
            self::rdataValues($rrset['records'] ?? [], $type),
        );

        return new DnsRrsetPatchOp(PatchOp::UPSERT, new DnsRrsetPatch($name, $records, $ttl, $type));
    }

    private static function removeOp(string $zoneName, mixed $rrset): DnsRrsetPatchOp
    {
        [$name, $type, $ttl] = self::parseRrset($zoneName, $rrset);

        return new DnsRrsetPatchOp(PatchOp::REMOVE, new DnsRrsetPatch($name, [], $ttl, $type));
    }

    /**
     * @return array{string, string, int}
     */
    private static function parseRrset(string $zoneName, mixed $rrset): array
    {
        if (!is_array($rrset)) {
            throw new InvalidArgumentException('Invalid record data');
        }

        return [
            self::buildRrsetName($zoneName, $rrset['name'] ?? ''),
            self::editableType($rrset['type'] ?? ''),
            (int) ($rrset['ttl'] ?? self::DEFAULT_TTL),
        ];
    }

    /**
     * The fully qualified record set name for a name typed relative to the zone. Fully qualified names must be inside
     * the zone.
     */
    private static function buildRrsetName(string $zoneName, mixed $name): string
    {
        $name = is_string($name) ? trim($name) : '';

        if ($name === '' || $name === '@') {
            return $zoneName . '.';
        }

        $fullName = str_ends_with($name, '.') ? $name : $name . '.' . $zoneName . '.';

        if (!self::isInZone($fullName, $zoneName)) {
            throw new InvalidArgumentException('The record name must be inside the zone');
        }

        return $fullName;
    }

    private static function isInZone(string $fullName, string $zoneName): bool
    {
        $lowerName = strtolower($fullName);
        $zoneRoot = strtolower($zoneName) . '.';

        return $lowerName === $zoneRoot || str_ends_with($lowerName, '.' . $zoneRoot);
    }

    private static function editableType(mixed $type): string
    {
        $rrsetType = is_string($type) ? DnsRrsetType::tryFrom(trim($type)) : null;

        if ($rrsetType === null || !DnsZoneHelper::isUserEditableType($rrsetType)) {
            throw new InvalidArgumentException('This record type cannot be changed');
        }

        return $rrsetType->value;
    }

    /**
     * The rdata of each record. TXT values are quoted as the API expects.
     *
     * @return non-empty-list<string>
     */
    private static function rdataValues(mixed $records, string $type): array
    {
        $values = [];

        foreach ((array) $records as $record) {
            $rdata = is_array($record) ? ($record['rdata'] ?? null) : $record;

            if (!is_string($rdata)) {
                throw new InvalidArgumentException('Invalid record data');
            }

            $values[] = $type === DnsRrsetType::TXT->value ? TxtRecordHelper::normalize($rdata) : trim($rdata);
        }

        if ($values === []) {
            throw new InvalidArgumentException('Invalid record data');
        }

        return $values;
    }
}
