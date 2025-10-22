<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS;

use WHMCS\Module\Registrar\OpusDNS\ApiException;

const VERSION = "1.0.0";

class ApiConfig
{
    public const PRODUCTION_BASE_URL = "https://api.opusdns.com";
    public const SANDBOX_BASE_URL = "https://api.preview1.opusdns.dev";
    public const DEFAULT_API_VERSION = "v1";
    public const DEFAULT_USER_AGENT = "OpusDNS-whmcs/" . VERSION;
    public const DEFAULT_TIMEOUT = 300;
    public const DEFAULT_CONNECT_TIMEOUT = 60;

    private array $config;
    
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->getDefaults(), $config);
        $this->resolveBaseUrl();
        $this->validate();
    }
    
    private function getDefaults(): array
    {
        return [
            'base_url' => self::PRODUCTION_BASE_URL,
            'api_version' => self::DEFAULT_API_VERSION,
            'user_agent' => self::DEFAULT_USER_AGENT,
            'timeout' => self::DEFAULT_TIMEOUT,
            'connect_timeout' => self::DEFAULT_CONNECT_TIMEOUT,
            'verify_ssl' => true,
            'proxy_url' => null,
            'http_options' => [],
        ];
    }
    
    private function resolveBaseUrl(): void
    {
        if (!empty($this->config['TestMode']) && $this->config['TestMode'] === 'on') {
            $this->config['base_url'] = self::SANDBOX_BASE_URL;
        }
    }
    
    private function validate(): void
    {
        $this->validateAuthCredentials();

        if (!filter_var($this->config['base_url'], FILTER_VALIDATE_URL)) {
            throw new ApiException(
                "Invalid base URL: {$this->config['base_url']}",
                0,
                'configuration_error'
            );
        }

        if (!preg_match('/^v\d+$/', $this->config['api_version'])) {
            throw new ApiException(
                "Invalid API version format: {$this->config['api_version']}. Must be 'v1', 'v2', etc.",
                0,
                'configuration_error'
            );
        }

        if ($this->config['timeout'] < 1 || $this->config['timeout'] > 300) {
            throw new ApiException(
                'Timeout must be between 1 and 300 seconds',
                0,
                'configuration_error'
            );
        }

        if ($this->config['proxy_url'] && !filter_var($this->config['proxy_url'], FILTER_VALIDATE_URL)) {
            throw new ApiException(
                "Invalid proxy URL: {$this->config['proxy_url']}",
                0,
                'configuration_error'
            );
        }
    }
    
    public function validateAuthCredentials(): void
    {
        $required = ['ClientID', 'ClientSecret'];
        $missing = [];

        foreach ($required as $field) {
            if (empty($this->config[$field])) {
                $missing[] = $field;
            }
        }

        if ($missing !== []) {
            throw new ApiException(
                "Missing required auth credentials: " . implode(', ', $missing),
                0,
                'authentication_error'
            );
        }
    }
    
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->config[$key] ?? $default;
    }
    
    public function getClientId(): string
    {
        return $this->config['ClientID'];
    }
    
    public function getClientSecret(): string
    {
        return $this->config['ClientSecret'];
    }
    
    public function getBaseUrl(): string
    {
        return rtrim($this->config['base_url'], '/');
    }
    
    public function getApiVersion(): string
    {
        return $this->config['api_version'];
    }
    
    public function getUserAgent(): string
    {
        return $this->config['user_agent'];
    }
    
    public function getTimeout(): int
    {
        return $this->config['timeout'];
    }
    
    public function getConnectTimeout(): int
    {
        return $this->config['connect_timeout'];
    }
    
    public function isVerifySslEnabled(): bool
    {
        return $this->config['verify_ssl'];
    }
    
    public function getProxyUrl(): ?string
    {
        return $this->config['proxy_url'];
    }
    
    public function getHttpOptions(): array
    {
        $options = [
            'timeout' => $this->getTimeout(),
            'connect_timeout' => $this->getConnectTimeout(),
            'verify' => $this->isVerifySslEnabled(),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ];

        if ($this->getProxyUrl()) {
            $options['proxy'] = $this->getProxyUrl();
        }

        return array_merge_recursive($options, $this->config['http_options']);
    }
    
    public function getTokenEndpoint(): string
    {
        return "/{$this->getApiVersion()}/auth/token";
    }
    
    public function getVersionedPath(string $path): string
    {
        return "/{$this->getApiVersion()}/" . ltrim($path, "/");
    }
}
