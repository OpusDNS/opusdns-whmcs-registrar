<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;
use WHMCS\Module\Registrar\OpusDNS\Enum\DnsRrsetType;
use DateTimeImmutable;

class DnsZone
{
    use ModelTrait;

    private string $name = '';
    private string $dnssec_status = '';
    private ?array $domain_parts = null;
    private ?array $rrsets = null;
    private ?DateTimeImmutable $created_on = null;
    private ?DateTimeImmutable $updated_on = null;

    public function __construct(array $data = [])
    {
        $this->name = $data['name'] ?? '';
        $this->dnssec_status = $data['dnssec_status'] ?? '';
        $this->domain_parts = $data['domain_parts'] ?? null;
        $this->created_on = $this->parseDateField($data, 'created_on');
        $this->updated_on = $this->parseDateField($data, 'updated_on');

        $rrsets = $data['rrsets'] ?? [];
        $this->rrsets = array_map(
            fn(array $rrset) => new DnsRrset($rrset),
            $rrsets
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDnssecStatus(): string
    {
        return $this->dnssec_status;
    }

    public function getDomainParts(): ?array
    {
        return $this->domain_parts;
    }

    public function getCreatedOn(): ?DateTimeImmutable
    {
        return $this->created_on;
    }

    public function getUpdatedOn(): ?DateTimeImmutable
    {
        return $this->updated_on;
    }

    public function getRrsets(): ?array
    {
        return $this->rrsets;
    }

    public function getUserEditableRecords(string $domainName): array
    {
        if (!$this->rrsets) {
            return [];
        }

        $records = [];

        foreach ($this->rrsets as $rrset) {
            $type = $rrset->getType();

            if (
                $type === DnsRrsetType::SOA->value || $type === DnsRrsetType::NS->value ||
                $type === DnsRrsetType::DS->value || $type === DnsRrsetType::DNSKEY->value
            ) {
                continue;
            }

            $rdataList = array_map(
                fn(DnsRdata $record) => ['rdata' => $record->getRdata()],
                $rrset->getRecords()
            );

            $records[] = [
                'name' => $rrset->getName(),
                'type' => $type,
                'ttl' => $rrset->getTtl(),
                'records' => $rdataList,
            ];
        }

        return $records;
    }

    public function getZoneSoaRecord(): ?array
    {
        if (!$this->rrsets) {
            return null;
        }

        foreach ($this->rrsets as $rrset) {
            if ($rrset->getType() === DnsRrsetType::SOA->value) {
                $records = $rrset->getRecords();
                if (!empty($records)) {
                    return $this->parseSoaRdata($records[0]->getRdata());
                }
            }
        }

        return null;
    }

    public function getZoneNsRecords(): array
    {
        if (!$this->rrsets) {
            return [];
        }

        $ns = [];
        foreach ($this->rrsets as $rrset) {
            if ($rrset->getType() === DnsRrsetType::NS->value) {
                foreach ($rrset->getRecords() as $record) {
                    $ns[] = rtrim($record->getRdata(), '.');
                }
            }
        }

        return $ns;
    }

    public function getZoneDsRecords(): array
    {
        if (!$this->rrsets) {
            return [];
        }

        $dsRecords = [];
        foreach ($this->rrsets as $rrset) {
            if ($rrset->getType() === DnsRrsetType::DS->value) {
                foreach ($rrset->getRecords() as $record) {
                    $dsRecords[] = $this->parseDsRdata($record->getRdata());
                }
            }
        }

        return $dsRecords;
    }

    public function getZoneDnskeyRecords(): array
    {
        if (!$this->rrsets) {
            return [];
        }

        $dnskeyRecords = [];
        foreach ($this->rrsets as $rrset) {
            if ($rrset->getType() === DnsRrsetType::DNSKEY->value) {
                foreach ($rrset->getRecords() as $record) {
                    $dnskeyRecords[] = $this->parseDnskeyRdata($record->getRdata());
                }
            }
        }

        return $dnskeyRecords;
    }

    private function parseSoaRdata(string $rdata): array
    {
        $parts = explode(' ', $rdata);
        $primaryNs = rtrim($parts[0] ?? '', '.');
        $emailRaw = rtrim($parts[1] ?? '', '.');
        $firstDotPos = strpos($emailRaw, '.');
        $email = $firstDotPos !== false
            ? substr_replace($emailRaw, '@', $firstDotPos, 1)
            : $emailRaw;

        return [
            'primary_ns' => $primaryNs,
            'email' => $email,
            'serial' => $parts[2] ?? '',
            'refresh' => $parts[3] ?? '',
            'retry' => $parts[4] ?? '',
            'expire' => $parts[5] ?? '',
            'min_ttl' => $parts[6] ?? '',
            'raw' => $rdata,
        ];
    }

    private function parseDsRdata(string $rdata): array
    {
        $parts = preg_split('/\s+/', $rdata, 4);

        return [
            'key_tag' => (int) ($parts[0] ?? 0),
            'algorithm' => (int) ($parts[1] ?? 0),
            'digest_type' => (int) ($parts[2] ?? 0),
            'digest' => $parts[3] ?? '',
            'raw' => $rdata,
        ];
    }

    private function parseDnskeyRdata(string $rdata): array
    {
        $parts = preg_split('/\s+/', $rdata, 4);

        return [
            'flags' => (int) ($parts[0] ?? 0),
            'protocol' => (int) ($parts[1] ?? 0),
            'algorithm' => (int) ($parts[2] ?? 0),
            'public_key' => $parts[3] ?? '',
            'raw' => $rdata,
        ];
    }
}
