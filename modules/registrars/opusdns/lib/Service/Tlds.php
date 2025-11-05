<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Models\Tld;

class Tlds extends BaseService
{
    private const CACHE_FILE = 'tlds.json';
    private const CACHE_TTL = 86400;
    private const DEFAULT_TLD_FIELDS = [
        'enabled',
        'tlds',
        'domain_lifecycle',
        'domain_statuses',
        'contacts',
        'transfer_policies',
    ];

    public function list(?array $fields = null): ApiResponse
    {
        $queryParams = [];
        
        if ($fields === null) {
            $fields = self::DEFAULT_TLD_FIELDS;
        }
        
        if (!empty($fields)) {
            $queryParams['fields'] = implode(',', $fields);
        }
        
        return $this->getResource('/tlds', $queryParams, null);
    }

    public function getTlds(bool $useCache = true): array
    {
        if ($useCache && $cached = $this->loadCache()) {
            return $cached;
        }

        $response = $this->list();
        $data = $response->getData();
        $tlds = array_map(fn($tldData) => new Tld($tldData), $data['tlds'] ?? []);
        
        if ($useCache) {
            $this->saveCache($data['tlds'] ?? []);
        }

        return $tlds;
    }

    public function getTld(string $tldName, bool $useCache = true): ?Tld
    {
        foreach ($this->getTlds($useCache) as $tldGroup) {
            foreach ($tldGroup->getTlds() as $tld) {
                if (($tld['name'] ?? null) === $tldName) {
                    return $tldGroup;
                }
            }
        }
        
        return null;
    }

    public function refreshCache(): bool
    {
        try {
            $this->getTlds(false);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function loadCache(): ?array
    {
        $cacheFile = $this->getCacheFilePath();
        
        if (!file_exists($cacheFile) || (time() - filemtime($cacheFile)) > self::CACHE_TTL) {
            return null;
        }

        $data = json_decode(file_get_contents($cacheFile), true);
        return is_array($data) ? array_map(fn($tldData) => new Tld($tldData), $data) : null;
    }

    private function saveCache(array $tlds): void
    {
        $cacheFile = $this->getCacheFilePath();
        
        if (!is_dir($dir = dirname($cacheFile))) {
            mkdir($dir, 0755, true);
        }

        file_put_contents($cacheFile, json_encode($tlds, JSON_PRETTY_PRINT));
    }

    private function getCacheFilePath(): string
    {
        return __DIR__ . '/../../resources/' . self::CACHE_FILE;
    }
}
