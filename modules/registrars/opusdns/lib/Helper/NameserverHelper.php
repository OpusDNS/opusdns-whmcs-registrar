<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

class NameserverHelper
{
    public static function extractFromParams(array $params): array
    {
        return array_filter([
            ['hostname' => $params['ns1'] ?? null],
            ['hostname' => $params['ns2'] ?? null],
            ['hostname' => $params['ns3'] ?? null],
            ['hostname' => $params['ns4'] ?? null],
            ['hostname' => $params['ns5'] ?? null],
        ], fn($ns) => !empty($ns['hostname']));
    }

    public static function buildApiFormat(array $nameservers): array
    {
        return array_map(fn($ns) => [
            'hostname' => is_string($ns) ? $ns : ($ns['hostname'] ?? ''),
            'ip_addresses' => [],
        ], $nameservers);
    }
}
