<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\ResponseInterface;
use WHMCS\Module\Registrar\OpusDNS\ApiException;
use WHMCS\Module\Registrar\OpusDNS\Service\Auth;
use WHMCS\Module\Registrar\OpusDNS\Service\Availability;
use WHMCS\Module\Registrar\OpusDNS\Service\Contacts;
use WHMCS\Module\Registrar\OpusDNS\Service\Dns;
use WHMCS\Module\Registrar\OpusDNS\Service\DomainSearch;
use WHMCS\Module\Registrar\OpusDNS\Service\Domains;
use WHMCS\Module\Registrar\OpusDNS\Service\Hosts;
use WHMCS\Module\Registrar\OpusDNS\Service\Pricing;
use WHMCS\Module\Registrar\OpusDNS\Service\Tlds;

class ApiClient
{
    private GuzzleClient $httpClient;

    public function __construct(
        private readonly ?string $accessToken,
        private readonly ApiConfig $config,
        ?GuzzleClient $httpClient = null,
        private readonly ?string $apiKey = null
    ) {
        $this->httpClient = $httpClient ?? $this->createHttpClient();
    }
    
    public static function create(
        array $config,
        ?GuzzleClient $authClient = null,
        ?ApiAuth $auth = null
    ): self {
        $configInstance = new ApiConfig($config);

        if ($configInstance->isApiKeyAuth()) {
            return new self(null, $configInstance, null, $configInstance->getApiKey());
        }

        if ($auth === null) {
            $httpClient = $authClient ?? new GuzzleClient([
                'base_uri' => $configInstance->getBaseUrl(),
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'verify' => $configInstance->isVerifySslEnabled(),
                'timeout' => $configInstance->getTimeout(),
                'connect_timeout' => $configInstance->getConnectTimeout(),
            ]);

            $auth = new ApiAuth($configInstance, $httpClient);
        }

        $accessToken = $auth->getAccessToken();

        if ($accessToken === null) {
            throw new ApiException(
                'Failed to obtain access token',
                0,
                'authentication_error'
            );
        }

        return new self($accessToken, $configInstance);
    }
    
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
    
    public function getConfig(): ApiConfig
    {
        return $this->config;
    }

    public function getHttpClient(): GuzzleClient
    {
        return $this->httpClient;
    }
    
    public function request(string $method, string $path, array $options = []): ResponseInterface
    {
        $authHeader = $this->apiKey !== null
            ? ['X-Api-Key' => $this->apiKey]
            : ['Authorization' => 'Bearer ' . $this->accessToken];

        $requestOptions = array_merge_recursive($options, [
            "headers" => array_merge($authHeader, [
                "Accept" => "application/json",
                "User-Agent" => $this->config->getUserAgent(),
            ]),
        ]);

        try {
            return $this->httpClient->request($method, $path, $requestOptions);
        } catch (ClientException $e) {
            throw ApiException::fromResponse($e->getResponse(), $e);
        } catch (ServerException $e) {
            throw ApiException::fromResponse($e->getResponse(), $e);
        } catch (ConnectException $e) {
            throw new ApiException(
                "Network connection failed: " . $e->getMessage(),
                0,
                'network_error',
                null,
                null,
                $e
            );
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response) {
                throw ApiException::fromResponse($response, $e);
            }

            throw new ApiException(
                "Request failed: " . $e->getMessage(),
                0,
                'request_error',
                null,
                null,
                $e
            );
        } catch (GuzzleException $e) {
            throw new ApiException(
                "HTTP client error: " . $e->getMessage(),
                0,
                'http_client_error',
                null,
                null,
                $e
            );
        }
    }
    
    public function getResource(string $path, array $options = []): ResponseInterface
    {
        return $this->request('GET', $this->config->getVersionedPath($path), $options);
    }
    
    public function postResource(string $path, array $attributes = []): ResponseInterface
    {
        return $this->request('POST', $this->config->getVersionedPath($path), $attributes);
    }
    
    public function deleteResource(string $path, array $options = []): ResponseInterface
    {
        return $this->request('DELETE', $this->config->getVersionedPath($path), $options);
    }
    
    public function patchResource(string $path, array $attributes = []): ResponseInterface
    {
        return $this->request('PATCH', $this->config->getVersionedPath($path), $attributes);
    }
    
    public function putResource(string $path, array $attributes = []): ResponseInterface
    {
        return $this->request('PUT', $this->config->getVersionedPath($path), $attributes);
    }
    
    private function createHttpClient(): GuzzleClient
    {
        return new GuzzleClient([
            'base_uri' => $this->config->getBaseUrl(),
            ...$this->config->getHttpOptions(),
        ]);
    }
    
    public function auth(): Auth
    {
        return new Auth($this);
    }

    public function availability(): Availability
    {
        return new Availability($this);
    }
    
    public function contacts(): Contacts
    {
        return new Contacts($this);
    }
    
    public function domainSearch(): DomainSearch
    {
        return new DomainSearch($this);
    }
    
    public function domains(): Domains
    {
        return new Domains($this);
    }
    
    public function pricing(): Pricing
    {
        return new Pricing($this);
    }
    
    public function tlds(): Tlds
    {
        return new Tlds($this);
    }

    public function dns(): Dns
    {
        return new Dns($this);
    }

    public function hosts(): Hosts
    {
        return new Hosts($this);
    }
}
