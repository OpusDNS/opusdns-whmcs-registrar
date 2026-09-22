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
use WHMCS\Module\Registrar\OpusDNS\Helper\TxtRecordHelper;

/**
 * Turns the record forms of the DNS zone page into patch operations and sends them.
 */
class Dns
{
    public const DEFAULT_TTL = 3600;

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * Adds the posted records to their record set, keeping the records already in it.
     *
     * @param array<string, mixed> $formData
     */
    public function addRecordsFromFormData(string $zoneName, array $formData): void
    {
        [$name, $type, $ttl, $rdataValues] = $this->parseFormData($zoneName, $formData);

        $ops = array_map(
            static fn (string $rdata): DnsRecordPatchOp => new DnsRecordPatchOp(
                PatchOp::UPSERT,
                new DnsRrsetWithOneRecordPatch($name, $rdata, $ttl, $type),
            ),
            $rdataValues,
        );

        $this->client->dns()->patchZoneRecords($zoneName, new DnsZoneRecordsPatchOps($ops));
    }

    /**
     * Replaces a record set with the posted records.
     *
     * @param array<string, mixed> $formData
     */
    public function updateRrsetFromFormData(string $zoneName, array $formData): void
    {
        [$name, $type, $ttl, $rdataValues] = $this->parseFormData($zoneName, $formData);

        $this->patchRrsets($zoneName, [
            new DnsRrsetPatchOp(PatchOp::UPSERT, new DnsRrsetPatch($name, self::records($rdataValues), $ttl, $type)),
        ]);
    }

    /**
     * @param array<string, mixed> $formData
     */
    public function deleteRrsetFromFormData(string $zoneName, array $formData): void
    {
        $name = $this->buildRrsetName($zoneName, (string) ($formData['name'] ?? ''));
        $type = trim((string) ($formData['type'] ?? ''));
        $ttl = (int) ($formData['ttl'] ?? self::DEFAULT_TTL);

        $this->patchRrsets($zoneName, [
            new DnsRrsetPatchOp(PatchOp::REMOVE, new DnsRrsetPatch($name, [], $ttl, $type)),
        ]);
    }

    /**
     * Replaces every given record set. TXT values are quoted as the API expects.
     *
     * @param list<array<string, mixed>> $rrsets Each with name, type, ttl and records, the records each with rdata
     */
    public function upsertRrsets(string $zoneName, array $rrsets): void
    {
        $ops = [];

        foreach ($rrsets as $rrset) {
            $type = (string) ($rrset['type'] ?? '');
            $rdataValues = [];
            foreach ($rrset['records'] ?? [] as $record) {
                $rdata = is_array($record) ? (string) ($record['rdata'] ?? '') : (string) $record;
                $rdataValues[] = $type === DnsRrsetType::TXT->value ? TxtRecordHelper::normalize($rdata) : $rdata;
            }

            $ops[] = new DnsRrsetPatchOp(PatchOp::UPSERT, new DnsRrsetPatch(
                (string) ($rrset['name'] ?? ''),
                self::records($rdataValues),
                (int) ($rrset['ttl'] ?? self::DEFAULT_TTL),
                $type,
            ));
        }

        $this->patchRrsets($zoneName, $ops);
    }

    /**
     * Removes every given record set.
     *
     * @param list<array<string, mixed>> $rrsets Each with name, type and ttl
     */
    public function deleteRrsets(string $zoneName, array $rrsets): void
    {
        $ops = array_map(
            static fn (array $rrset): DnsRrsetPatchOp => new DnsRrsetPatchOp(PatchOp::REMOVE, new DnsRrsetPatch(
                (string) ($rrset['name'] ?? ''),
                [],
                (int) ($rrset['ttl'] ?? self::DEFAULT_TTL),
                (string) ($rrset['type'] ?? ''),
            )),
            $rrsets,
        );

        $this->patchRrsets($zoneName, $ops);
    }

    /**
     * @param list<DnsRrsetPatchOp> $ops
     */
    private function patchRrsets(string $zoneName, array $ops): void
    {
        $this->client->dns()->patchZoneRrsets($zoneName, new DnsZoneRrsetsPatchOps($ops));
    }

    /**
     * @param list<string> $rdataValues
     * @return list<DnsRecordCreate>
     */
    private static function records(array $rdataValues): array
    {
        return array_map(static fn (string $rdata): DnsRecordCreate => new DnsRecordCreate($rdata), $rdataValues);
    }

    /**
     * The record set name, type, TTL and rdata values of a posted form.
     *
     * @param array<string, mixed> $formData
     * @return array{string, string, int, list<string>}
     */
    private function parseFormData(string $zoneName, array $formData): array
    {
        $name = $this->buildRrsetName($zoneName, (string) ($formData['name'] ?? ''));
        $type = trim((string) ($formData['type'] ?? ''));
        $ttl = (int) ($formData['ttl'] ?? self::DEFAULT_TTL);
        $rdataValues = $this->rdataFromFormData($formData, $type);

        if ($type === '' || $rdataValues === []) {
            throw new InvalidArgumentException('Invalid record data');
        }

        return [$name, $type, $ttl, $rdataValues];
    }

    /**
     * The rdata values of a posted form, taken from its records list or its rdata field.
     *
     * @param array<string, mixed> $formData
     * @return list<string>
     */
    private function rdataFromFormData(array $formData, string $type): array
    {
        if (isset($formData['records']) && is_array($formData['records'])) {
            $rawValues = $formData['records'];
        } elseif (isset($formData['rdata'])) {
            $rawValues = is_array($formData['rdata']) ? $formData['rdata'] : [$formData['rdata']];
        } else {
            $rawValues = [];
        }

        $values = [];
        foreach ($rawValues as $rawValue) {
            $value = is_array($rawValue) ? (string) ($rawValue['rdata'] ?? '') : (string) $rawValue;
            $value = trim(html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $values[] = $type === DnsRrsetType::TXT->value ? TxtRecordHelper::normalize($value) : $value;
        }

        return $values;
    }

    /**
     * The fully qualified record set name for a name typed relative to the zone.
     */
    private function buildRrsetName(string $domainName, string $name): string
    {
        $name = trim($name);

        if ($name === '' || $name === '@') {
            return $domainName . '.';
        }

        if (str_ends_with($name, '.')) {
            return $name;
        }

        return $name . '.' . $domainName . '.';
    }
}
