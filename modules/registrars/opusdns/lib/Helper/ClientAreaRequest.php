<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

use App;
use Exception;
use InvalidArgumentException;
use WHMCS\Authentication\CurrentUser;
use WHMCS\Domain\Domain;
use WHMCS\Input\Sanitize;

/**
 * Authorizes client area calls to the custom module functions and reads their input through WHMCS.
 */
class ClientAreaRequest
{
    /**
     * Whether the logged in client owns the domain and WHMCS considers the domain active.
     *
     * @param array<string, mixed> $params
     */
    public static function canManageDomain(array $params): bool
    {
        $client = (new CurrentUser())->client();

        return $client !== null
            && Domain::ofClient($client->id)->isConsideredActive()->find($params['domainid']) !== null;
    }

    /**
     * Whether this is a POST request with a valid CSRF token.
     */
    public static function hasValidToken(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return false;
        }

        try {
            return check_token() === true;
        } catch (Exception) {
            return false;
        }
    }

    /**
     * The record set fields posted by the DNS zone page.
     *
     * @return array<string, mixed>
     */
    public static function rrsetFields(): array
    {
        return [
            'name' => self::decodedString('name'),
            'type' => self::decodedString('type'),
            'ttl' => self::decodedString('ttl'),
            'records' => self::decodedStrings('rdata'),
        ];
    }

    /**
     * The trimmed, decoded text of a request field, or an empty string when the field is not text.
     */
    public static function decodedString(string $field): string
    {
        $value = App::getFromRequest($field);

        return is_string($value) ? trim(Sanitize::decode($value)) : '';
    }

    /**
     * The decoded text values of a request field sent as an array, keeping their keys.
     *
     * @return array<string>
     */
    public static function decodedStrings(string $field): array
    {
        $values = App::getFromRequest($field);

        return is_array($values) ? array_filter(Sanitize::decode($values), is_string(...)) : [];
    }

    /**
     * The non-empty array held by a request field that contains JSON.
     *
     * @return non-empty-array<mixed>
     * @throws InvalidArgumentException When the field holds anything else
     */
    public static function decodedJsonArray(string $field): array
    {
        $decoded = json_decode(self::decodedString($field), true);

        if (!is_array($decoded) || $decoded === []) {
            throw new InvalidArgumentException('No data provided');
        }

        return $decoded;
    }
}
