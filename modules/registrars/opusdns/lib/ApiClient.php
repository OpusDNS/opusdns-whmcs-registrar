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
use WHMCS\Module\Registrar\OpusDNS\Service\Availability;
use WHMCS\Module\Registrar\OpusDNS\Service\Contacts;
use WHMCS\Module\Registrar\OpusDNS\Service\DomainSearch;
use WHMCS\Module\Registrar\OpusDNS\Service\Domains;

class ApiClient
{
    private GuzzleClient $httpClient;
    
    public function __construct(
        private readonly string $accessToken,
        private readonly ApiConfig $config,
        ?GuzzleClient $httpClient = null
    ) {
        $this->httpClient = $httpClient ?? $this->createHttpClient();
    }
    
    public static function create(
        array $config,
        ?GuzzleClient $authClient = null,
        ?ApiAuth $auth = null
    ): self {
        $configInstance = new ApiConfig($config);

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
        $requestOptions = array_merge_recursive($options, [
            "headers" => [
                "Authorization" => "Bearer " . $this->accessToken,
                "Accept" => "application/json",
                "User-Agent" => $this->config->getUserAgent(),
            ],
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
}
