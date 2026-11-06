<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Throwable;
use WHMCS\Config\Setting;

/**
 * Records every API call in the WHMCS module log.
 */
final class ModuleLoggingHttpClient implements ClientInterface
{
    private const SENSITIVE_FIELDS = [
        'auth_code',
        'password',
        'client_secret',
        'token',
        'access_token',
        'refresh_token',
    ];

    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly string $apiKey,
    ) {
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $exception) {
            $this->log($request, $exception->getMessage(), '');

            throw $exception;
        }

        $this->log($request, 'HTTP ' . $response->getStatusCode(), $response->getBody());

        return $response;
    }

    private function log(RequestInterface $request, string $outcome, StreamInterface|string $responseBody): void
    {
        try {
            if (!Setting::getValue('ModuleDebugMode')) {
                return;
            }

            $action = $request->getMethod() . ' ' . $request->getUri()->getPath();
            $requestData = trim("{$request->getMethod()} {$request->getUri()}\n\n{$request->getBody()}");
            $responseData = trim("{$outcome}\n\n{$responseBody}");
            $decodedRequest = (array) json_decode((string) $request->getBody(), true);
            $decodedResponse = (array) json_decode((string) $responseBody, true);
            $secrets = [$this->apiKey, ...$this->sensitiveValues([$decodedRequest, $decodedResponse])];

            logModuleCall(
                ApiClientFactory::REGISTRAR,
                $action,
                $requestData,
                $responseData,
                print_r($decodedResponse, true),
                $secrets,
            );
        } catch (Throwable $exception) {
            error_log('OpusDNS: writing the module log failed with ' . $exception::class);
        }
    }

    /**
     * Returns the sensitive values, each also in its JSON-escaped form.
     *
     * @param array<mixed> $data
     * @return list<string>
     */
    private function sensitiveValues(array $data): array
    {
        $values = [];

        foreach ($data as $field => $value) {
            if (is_array($value)) {
                $values = [...$values, ...$this->sensitiveValues($value)];
            } elseif (in_array($field, self::SENSITIVE_FIELDS, true) && is_string($value) && $value !== '') {
                $values[] = $value;
                $values[] = substr(json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), 1, -1);
            }
        }

        return $values;
    }
}
