<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use GuzzleHttp\RequestOptions;
use WHMCS\Module\Registrar\OpusDNS\ApiClient;
use WHMCS\Module\Registrar\OpusDNS\ApiResponse;

abstract class BaseService
{

    protected const MODEL_CLASS = null;

    public function __construct(protected ApiClient $client) {}

    protected function getResource(string $endpoint, array $query = [], ?string $modelClass = null): ApiResponse
    {
        $queryString = $this->buildQueryString($query);
        $httpResponse = $this->client->getResource($endpoint, [RequestOptions::QUERY => $queryString]);
        return new ApiResponse($httpResponse, $modelClass ?? static::MODEL_CLASS);
    }

    protected function postResource(string $endpoint, array $data = [], ?string $modelClass = null): ApiResponse
    {
        $httpResponse = $this->client->postResource($endpoint, [RequestOptions::JSON => $data]);
        return new ApiResponse($httpResponse, $modelClass ?? static::MODEL_CLASS);
    }

    protected function putResource(string $endpoint, array $data = [], ?string $modelClass = null): ApiResponse
    {
        $httpResponse = $this->client->putResource($endpoint, [RequestOptions::JSON => $data]);
        return new ApiResponse($httpResponse, $modelClass ?? static::MODEL_CLASS);
    }

    protected function patchResource(string $endpoint, array $data = [], ?string $modelClass = null): ApiResponse
    {
        $httpResponse = $this->client->patchResource($endpoint, [RequestOptions::JSON => $data]);;
        return new ApiResponse($httpResponse, $modelClass ?? static::MODEL_CLASS);
    }

    protected function deleteResource(string $endpoint): void
    {
        $this->client->deleteResource($endpoint);
    }

    protected function buildQueryString(array $params): string
    {
        $flattenedArray = [];

        foreach ($params as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    $flattenedArray[] = urlencode((string) $key) . '=' . urlencode((string) $item);
                }
            } else {
                if (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                }
                $flattenedArray[] = urlencode((string) $key) . '=' . urlencode((string) $value);
            }
        }

        return implode('&', $flattenedArray);
    }
}
