<?php

declare(strict_types=1);

namespace OpusDNS\Client;

final readonly class Config
{
    public const PRODUCTION_URL = 'https://api.opusdns.com';
    public const SANDBOX_URL = 'https://sandbox.opusdns.com';

    public const PRODUCT_NAME = 'opusdns-php-client';
    public const PACKAGE = 'opusdns/php-client';

    public string $baseUrl;

    public string $userAgent;

    public string $clientToken;

    /**
     * @param string $apiKey API key sent in the X-Api-Key header
     * @param string $baseUrl Production or sandbox URL, without a trailing slash
     * @param string|null $userAgent User-Agent header; defaults to the client token
     * @param array<string, string> $headers Extra headers sent with every request
     * @param float $timeout Request timeout in seconds, used when Client::create() builds the Guzzle client
     * @param float $connectTimeout Connection timeout in seconds, used when Client::create() builds the Guzzle client
     * @param string|null $clientToken Sent as X-OpusDNS-Client; an empty string omits the header
     */
    public function __construct(
        public string $apiKey,
        string $baseUrl = self::PRODUCTION_URL,
        ?string $userAgent = null,
        public array $headers = [],
        public float $timeout = 60.0,
        public float $connectTimeout = 10.0,
        ?string $clientToken = null,
    ) {
        if (trim($apiKey) === '') {
            throw new \InvalidArgumentException('An API key is required.');
        }
        if (filter_var($baseUrl, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException("Invalid base URL: {$baseUrl}");
        }
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->clientToken = $clientToken ?? self::defaultClientToken();
        $this->userAgent = $userAgent ?? self::defaultClientToken();
    }

    public static function production(string $apiKey): self
    {
        return new self($apiKey);
    }

    public static function sandbox(string $apiKey): self
    {
        return new self($apiKey, self::SANDBOX_URL);
    }

    public static function defaultClientToken(): string
    {
        return self::PRODUCT_NAME . '/' . self::version();
    }

    public static function version(): string
    {
        if (class_exists(\Composer\InstalledVersions::class) && \Composer\InstalledVersions::isInstalled(self::PACKAGE)) {
            $version = ltrim((string) \Composer\InstalledVersions::getPrettyVersion(self::PACKAGE), 'v');
            if (preg_match('/^\d+\.\d+\.\d+([.\-][0-9A-Za-z.\-]+)?$/', $version) === 1) {
                return $version;
            }
        }

        return 'dev';
    }
}
