<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use WHMCS\Module\Registrar\OpusDNS\ApiException;
use WHMCS\Module\Registrar\OpusDNS\Enum\GrantType;

class ApiAuth
{
    private ?string $accessToken = null;
    private ?int $tokenExpiry = null;
    
    public function __construct(
        private readonly ApiConfig $config,
        private readonly GuzzleClient $httpClient
    ) {
    }
    
    public function getAccessToken(): ?string
    {
        if ($this->isTokenValid()) {
            return $this->accessToken;
        }

        return $this->fetchNewToken();
    }
    
    private function isTokenValid(): bool
    {
        return $this->accessToken !== null
            && $this->tokenExpiry !== null
            && time() < $this->tokenExpiry;
    }
    
    private function fetchNewToken(): string
    {
        try {
            $response = $this->httpClient->post($this->config->getTokenEndpoint(), [
                "form_params" => [
                    "grant_type" => GrantType::CLIENT_CREDENTIALS->value,
                    "client_id" => $this->config->getClientId(),
                    "client_secret" => $this->config->getClientSecret()
                ]
            ]);

            $data = json_decode((string)$response->getBody(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new ApiException(
                    "Failed to decode token response: " . json_last_error_msg(),
                    0,
                    'authentication_error'
                );
            }

            $this->accessToken = $data['access_token'] ?? null;
            $expiresIn = $data['expires_in'] ?? 3600;
            $this->tokenExpiry = time() + $expiresIn - 60;

            if (!$this->accessToken) {
                throw new ApiException(
                    "No access token received from OAuth2 endpoint",
                    0,
                    'authentication_error'
                );
            }

            return $this->accessToken;
        } catch (ClientException $e) {
            throw ApiException::fromResponse($e->getResponse(), $e);
        } catch (ServerException $e) {
            throw ApiException::fromResponse($e->getResponse(), $e);
        } catch (ConnectException $e) {
            throw new ApiException(
                "Network connection failed during authentication: " . $e->getMessage(),
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
                "Authentication request failed: " . $e->getMessage(),
                0,
                'authentication_error',
                null,
                null,
                $e
            );
        } catch (GuzzleException $e) {
            throw new ApiException(
                "HTTP client error during authentication: " . $e->getMessage(),
                0,
                'authentication_error',
                null,
                null,
                $e
            );
        } catch (\Exception $e) {
            throw new ApiException(
                "OAuth2 authentication failed: " . $e->getMessage(),
                0,
                'authentication_error',
                null,
                null,
                $e
            );
        }
    }
    
    public function clearToken(): void
    {
        $this->accessToken = null;
        $this->tokenExpiry = null;
    }
}
