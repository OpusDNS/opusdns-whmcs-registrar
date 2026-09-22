<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

use OpusDNS\Client\Model\Nameserver;

class NameserverHelper
{
    private const PARAM_KEYS = ['ns1', 'ns2', 'ns3', 'ns4', 'ns5'];

    /**
     * The nameservers WHMCS passes as ns1 to ns5, skipping the empty ones.
     *
     * @param array<string, mixed> $params
     * @return list<Nameserver>
     */
    public static function extractFromParams(array $params): array
    {
        $nameservers = [];

        foreach (self::PARAM_KEYS as $key) {
            $hostname = trim((string) ($params[$key] ?? ''));
            if ($hostname !== '') {
                $nameservers[] = new Nameserver($hostname);
            }
        }

        return $nameservers;
    }

    /**
     * Nameservers posted by the DNS zone page, given as hostnames or as objects with a hostname key.
     *
     * @param list<string|array<string, mixed>> $nameservers
     * @return list<Nameserver>
     */
    public static function buildApiFormat(array $nameservers): array
    {
        $result = [];

        foreach ($nameservers as $nameserver) {
            $hostname = is_string($nameserver) ? $nameserver : (string) ($nameserver['hostname'] ?? '');
            $result[] = new Nameserver($hostname, []);
        }

        return $result;
    }

    /**
     * Nameservers keyed ns1, ns2 and so on, as WHMCS expects them.
     *
     * @param list<Nameserver>|null $nameservers
     * @return array<string, string>
     */
    public static function toWhmcsArray(?array $nameservers): array
    {
        $result = [];
        $position = 1;

        foreach ($nameservers ?? [] as $nameserver) {
            $result['ns' . $position] = $nameserver->hostname;
            $position++;
        }

        return $result;
    }
}
