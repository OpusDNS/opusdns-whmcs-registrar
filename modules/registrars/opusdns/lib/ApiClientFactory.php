<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS;

use InvalidArgumentException;
use OpusDNS\Client\Client;
use OpusDNS\Client\Config;

/**
 * Builds the OpusDNS API client from the registrar module settings. Authentication is by API key only.
 */
final class ApiClientFactory
{
    public const REGISTRAR = 'opusdns';
    public const VERSION_FILE = __DIR__ . '/../VERSION';
    public const REQUEST_TIMEOUT = 300.0;
    public const CONNECT_TIMEOUT = 60.0;

    /**
     * The module version from the VERSION file, which the release workflow writes; dev without it.
     */
    public static function moduleVersion(): string
    {
        $version = is_file(self::VERSION_FILE) ? trim((string) file_get_contents(self::VERSION_FILE)) : '';

        return $version === '' ? 'dev' : $version;
    }

    public static function userAgent(): string
    {
        return 'opusdns-whmcs/' . self::moduleVersion();
    }

    /**
     * Returns the API client for the saved registrar settings, or null when no API key is configured.
     */
    public static function fromRegistrarSettings(): ?Client
    {
        require_once ROOTDIR . '/includes/registrarfunctions.php';

        $params = getRegistrarConfigOptions(self::REGISTRAR);

        if (trim((string) ($params['ApiKey'] ?? '')) === '') {
            return null;
        }

        return self::fromParams($params);
    }

    /**
     * @param array<string, mixed> $params Module parameters as WHMCS passes them, including ApiKey and TestMode
     */
    public static function fromParams(array $params): Client
    {
        $apiKey = trim((string) ($params['ApiKey'] ?? ''));
        if ($apiKey === '') {
            throw new InvalidArgumentException('The OpusDNS API key is not configured.');
        }

        $baseUrl = ($params['TestMode'] ?? '') === 'on' ? Config::SANDBOX_URL : Config::PRODUCTION_URL;
        $userAgent = self::userAgent();

        return Client::create(new Config(
            apiKey: $apiKey,
            baseUrl: $baseUrl,
            userAgent: $userAgent,
            clientToken: $userAgent,
            timeout: self::REQUEST_TIMEOUT,
            connectTimeout: self::CONNECT_TIMEOUT,
        ));
    }
}
