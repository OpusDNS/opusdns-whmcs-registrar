<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Enum\DnsOperation;
use WHMCS\Module\Registrar\OpusDNS\Enum\DnsRrsetType;
use WHMCS\Module\Registrar\OpusDNS\Models\DnsZone;
use WHMCS\Module\Registrar\OpusDNS\Helper\TxtRecordHelper;

class Dns extends BaseService
{
    protected const MODEL_CLASS = DnsZone::class;

    public function getZone(string $zoneName): ApiResponse
    {
        return $this->getResource("/dns/{$zoneName}");
    }

    public function addRrset(string $zoneName, string $name, string $type, int $ttl, array $records): ApiResponse
    {
        return $this->patchResource("/dns/{$zoneName}/rrsets", [
            'ops' => [
                [
                    'op' => DnsOperation::UPSERT->value,
                    'rrset' => [
                        'name' => $name,
                        'type' => $type,
                        'ttl' => $ttl,
                        'records' => $records,
                    ],
                ],
            ],
        ]);
    }

    public function updateRrset(string $zoneName, string $name, string $type, int $ttl, array $records): ApiResponse
    {
        return $this->addRrset($zoneName, $name, $type, $ttl, $records);
    }

    public function deleteRrset(string $zoneName, string $name, string $type, int $ttl): ApiResponse
    {
        return $this->patchResource("/dns/{$zoneName}/rrsets", [
            'ops' => [
                [
                    'op' => DnsOperation::REMOVE->value,
                    'rrset' => [
                        'name' => $name,
                        'type' => $type,
                        'ttl' => $ttl,
                        'records' => [],
                    ],
                ],
            ],
        ]);
    }

    public function deleteRrsets(string $zoneName, array $rrsets): ApiResponse
    {
        $ops = array_map(fn($rrset) => [
            'op' => DnsOperation::REMOVE->value,
            'rrset' => [
                'name' => $rrset['name'],
                'type' => $rrset['type'],
                'ttl' => $rrset['ttl'],
                'records' => [],
            ],
        ], $rrsets);

        return $this->patchResource("/dns/{$zoneName}/rrsets", ['ops' => $ops]);
    }

    public function upsertRrsets(string $zoneName, array $rrsets): ApiResponse
    {
        $ops = array_map(function ($rrset) {
            $normalizedRrset = $rrset;
            
            if (isset($rrset['type']) && $rrset['type'] === DnsRrsetType::TXT->value && isset($rrset['records'])) {
                $normalizedRrset['records'] = array_map(function ($record) {
                    if (isset($record['rdata'])) {
                        $record['rdata'] = TxtRecordHelper::normalize($record['rdata']);
                    }
                    return $record;
                }, $rrset['records']);
            }
            
            return [
                'op' => DnsOperation::UPSERT->value,
                'rrset' => $normalizedRrset,
            ];
        }, $rrsets);

        return $this->patchResource("/dns/{$zoneName}/rrsets", ['ops' => $ops]);
    }

    public function enableDnssec(string $zoneName): ApiResponse
    {
        return $this->postResource("/dns/{$zoneName}/dnssec/enable", []);
    }

    public function disableDnssec(string $zoneName): ApiResponse
    {
        return $this->postResource("/dns/{$zoneName}/dnssec/disable", []);
    }

    public function createZone(string $zoneName): ApiResponse
    {
        return $this->postResource('/dns', ['name' => $zoneName]);
    }

    public function deleteZone(string $zoneName): void
    {
        $this->deleteResource("/dns/{$zoneName}");
    }

    public function addRrsetFromFormData(string $zoneName, array $formData): ApiResponse
    {
        $name = $this->buildRrsetName($zoneName, $formData['name'] ?? '');
        $type = trim($formData['type'] ?? '');
        $ttl = (int)($formData['ttl'] ?? 3600);
        $records = $this->buildRecordsFromFormData($formData, $type);

        if (empty($type) || empty($records)) {
            throw new \InvalidArgumentException('Invalid record data');
        }

        return $this->addRrset($zoneName, $name, $type, $ttl, $records);
    }

    public function updateRrsetFromFormData(string $zoneName, array $formData): ApiResponse
    {
        return $this->addRrsetFromFormData($zoneName, $formData);
    }

    public function deleteRrsetFromFormData(string $zoneName, array $formData): ApiResponse
    {
        $name = $this->buildRrsetName($zoneName, $formData['name'] ?? '');
        $type = trim($formData['type'] ?? '');
        $ttl = (int)($formData['ttl'] ?? 3600);

        return $this->deleteRrset($zoneName, $name, $type, $ttl);
    }

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

    private function buildRecordsFromFormData(array $formData, string $type): array
    {
        $records = [];

        if (isset($formData['records']) && is_array($formData['records'])) {
            $records = array_map(function ($record) {
                $value = is_array($record) ? ($record['rdata'] ?? '') : $record;
                return html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }, $formData['records']);
        } elseif (isset($formData['rdata'])) {
            $rdataArray = is_array($formData['rdata']) ? $formData['rdata'] : [$formData['rdata']];
            $records = array_map(fn($value) => html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8'), $rdataArray);
        }

        return array_map(function ($rdata) use ($type) {
            $value = is_array($rdata) ? ($rdata['rdata'] ?? '') : $rdata;
            $trimmedValue = trim($value);
            
            if ($type === DnsRrsetType::TXT->value) {
                $trimmedValue = TxtRecordHelper::normalize($trimmedValue);
            }
            
            return ['rdata' => $trimmedValue];
        }, $records);
    }
}
