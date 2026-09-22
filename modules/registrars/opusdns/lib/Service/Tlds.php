<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use OpusDNS\Client\Client;
use WHMCS\Module\Registrar\OpusDNS\Models\Tld;

/**
 * The TLD specifications, fetched with the fields the module reads and cached on disk for a day.
 */
class Tlds
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
        'dns_configuration',
    ];

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * The listing as the API returns it, limited to the given fields.
     *
     * @param list<string>|null $fields
     * @return array<string, mixed>
     */
    public function list(?array $fields = null): array
    {
        $fields ??= self::DEFAULT_TLD_FIELDS;

        return $this->client->tld()->getTldSpecifications(fields: $fields === [] ? null : implode(',', $fields));
    }

    /**
     * @return list<Tld>
     */
    public function getTlds(bool $useCache = true): array
    {
        if ($useCache) {
            $cached = $this->loadCache();
            if ($cached) {
                return $cached;
            }
        }

        $tldData = $this->list()['tlds'] ?? [];

        if ($useCache) {
            $this->saveCache($tldData);
        }

        return array_map(static fn (array $entry): Tld => new Tld($entry), $tldData);
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
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @return list<Tld>|null
     */
    private function loadCache(): ?array
    {
        $cacheFile = $this->getCacheFilePath();

        if (!file_exists($cacheFile) || (time() - filemtime($cacheFile)) > self::CACHE_TTL) {
            return null;
        }

        $data = json_decode((string) file_get_contents($cacheFile), true);

        return is_array($data) ? array_map(static fn (array $entry): Tld => new Tld($entry), $data) : null;
    }

    /**
     * @param list<array<string, mixed>> $tlds
     */
    private function saveCache(array $tlds): void
    {
        $cacheFile = $this->getCacheFilePath();
        $directory = dirname($cacheFile);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        file_put_contents($cacheFile, json_encode($tlds, JSON_PRETTY_PRINT));
    }

    private function getCacheFilePath(): string
    {
        return __DIR__ . '/../../resources/' . self::CACHE_FILE;
    }
}
