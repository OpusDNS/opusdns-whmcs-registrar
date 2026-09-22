<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

use OpusDNS\Client\Enum\DnsRrsetType;
use OpusDNS\Client\Model\DnsRecordResponse;
use OpusDNS\Client\Model\DnsZoneResponse;

/**
 * Reads a zone into the structures the DNS zone page renders.
 */
class DnsZoneHelper
{
    private const ZONE_MANAGED_TYPES = [DnsRrsetType::SOA, DnsRrsetType::NS, DnsRrsetType::DS, DnsRrsetType::DNSKEY];

    /**
     * Every record set a customer may edit, that is all but the SOA, NS, DS and DNSKEY sets.
     *
     * @return list<array{name: string, type: string, ttl: int, records: list<array{rdata: string}>}>
     */
    public static function userEditableRecords(DnsZoneResponse $zone): array
    {
        $records = [];

        foreach ($zone->rrsets ?? [] as $rrset) {
            if (in_array($rrset->type, self::ZONE_MANAGED_TYPES, true)) {
                continue;
            }

            $records[] = [
                'name' => $rrset->name,
                'type' => $rrset->type instanceof DnsRrsetType ? $rrset->type->value : $rrset->type,
                'ttl' => $rrset->ttl,
                'records' => array_map(
                    static fn (DnsRecordResponse $record): array => ['rdata' => $record->rdata],
                    $rrset->records ?? [],
                ),
            ];
        }

        return $records;
    }

    /**
     * The parsed SOA record of the zone with the TTL of its set, or null when the zone has none.
     *
     * @return array<string, mixed>|null
     */
    public static function soaRecord(DnsZoneResponse $zone): ?array
    {
        foreach ($zone->rrsets ?? [] as $rrset) {
            if ($rrset->type !== DnsRrsetType::SOA) {
                continue;
            }

            $records = $rrset->records ?? [];
            if ($records === []) {
                continue;
            }

            $soa = self::parseSoaRdata($records[0]->rdata);
            $soa['ttl'] = $rrset->ttl;

            return $soa;
        }

        return null;
    }

    /**
     * The hostnames of the NS records at the zone apex, without the trailing dot.
     *
     * @return list<string>
     */
    public static function nameservers(DnsZoneResponse $zone): array
    {
        return array_map(
            static fn (string $rdata): string => rtrim($rdata, '.'),
            self::rdataOfType($zone, DnsRrsetType::NS),
        );
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function dsRecords(DnsZoneResponse $zone): array
    {
        return array_map(self::parseDsRdata(...), self::rdataOfType($zone, DnsRrsetType::DS));
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function dnskeyRecords(DnsZoneResponse $zone): array
    {
        return array_map(self::parseDnskeyRdata(...), self::rdataOfType($zone, DnsRrsetType::DNSKEY));
    }

    /**
     * @return list<string>
     */
    private static function rdataOfType(DnsZoneResponse $zone, DnsRrsetType $type): array
    {
        $values = [];

        foreach ($zone->rrsets ?? [] as $rrset) {
            if ($rrset->type !== $type) {
                continue;
            }
            foreach ($rrset->records ?? [] as $record) {
                $values[] = $record->rdata;
            }
        }

        return $values;
    }

    /**
     * @return array<string, mixed>
     */
    private static function parseSoaRdata(string $rdata): array
    {
        $parts = explode(' ', $rdata);
        $primaryNameserver = rtrim($parts[0], '.');
        $emailRaw = rtrim($parts[1] ?? '', '.');
        $firstDotPosition = strpos($emailRaw, '.');
        $email = $firstDotPosition !== false
            ? substr_replace($emailRaw, '@', $firstDotPosition, 1)
            : $emailRaw;

        return [
            'primary_ns' => $primaryNameserver,
            'email' => $email,
            'serial' => $parts[2] ?? '',
            'refresh' => $parts[3] ?? '',
            'retry' => $parts[4] ?? '',
            'expire' => $parts[5] ?? '',
            'min_ttl' => $parts[6] ?? '',
            'raw' => $rdata,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function parseDsRdata(string $rdata): array
    {
        $parts = preg_split('/\s+/', $rdata, 4) ?: [];

        return [
            'key_tag' => (int) ($parts[0] ?? 0),
            'algorithm' => (int) ($parts[1] ?? 0),
            'digest_type' => (int) ($parts[2] ?? 0),
            'digest' => $parts[3] ?? '',
            'raw' => $rdata,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function parseDnskeyRdata(string $rdata): array
    {
        $parts = preg_split('/\s+/', $rdata, 4) ?: [];

        return [
            'flags' => (int) ($parts[0] ?? 0),
            'protocol' => (int) ($parts[1] ?? 0),
            'algorithm' => (int) ($parts[2] ?? 0),
            'public_key' => $parts[3] ?? '',
            'raw' => $rdata,
        ];
    }
}
