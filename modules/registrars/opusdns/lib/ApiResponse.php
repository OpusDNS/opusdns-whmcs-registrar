<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS;

use Throwable;
use WHMCS\Module\Registrar\OpusDNS\Models\Pagination;
use WHMCS\Module\Registrar\OpusDNS\ApiException;
use Psr\Http\Message\ResponseInterface;

class ApiResponse
{
    private mixed $decodedBody = null;
    private bool $bodyDecoded = false;
    
    public function __construct(
        private readonly ResponseInterface $httpResponse,
        private readonly ?string $model = null
    ) {
    }
    
    public function getData(): mixed
    {
        $json = $this->getDecodedBody();

        // If no model is defined, return the decoded JSON directly
        if ($this->model === null) {
            return $json;
        }

        return $this->mapToModel($json, 'data');
    }
    
    public function getResults(): mixed
    {
        $json = $this->getDecodedBody();

        // If no model is defined, return the decoded JSON directly
        if ($this->model === null) {
            return $json;
        }

        return $this->mapToModel($json, 'results');
    }
    
    public function getPagination(): ?Pagination
    {
        $json = $this->getDecodedBody();

        // Check if the JSON array contains pagination data
        if (is_array($json) && isset($json['pagination'])) {
            $paginationData = $json['pagination'];

            // Validate required pagination fields
            $requiredFields = ['total_pages', 'total_items', 'current_page', 'page_size'];
            foreach ($requiredFields as $field) {
                if (!isset($paginationData[$field])) {
                    throw new ApiException(
                        "Invalid pagination data: missing required field '{$field}'",
                        0,
                        'invalid_pagination',
                        $this->getStatusCode(),
                        ['pagination_data' => $paginationData]
                    );
                }
            }

            return new Pagination($paginationData);
        }

        return null;
    }
    
    public function getMeta(): ?array
    {
        $json = $this->getDecodedBody();

        if (is_array($json) && isset($json['meta'])) {
            return $json['meta'];
        }

        return null;
    }
    
    public function getStatusCode(): int
    {
        return $this->httpResponse->getStatusCode();
    }
    
    public function getHeaders(): array
    {
        return $this->httpResponse->getHeaders();
    }
    
    public function getHeader(string $name): array
    {
        return $this->httpResponse->getHeader($name);
    }
    
    public function isSuccessful(): bool
    {
        $statusCode = $this->getStatusCode();
        return $statusCode >= 200 && $statusCode < 300;
    }
    
    public function isCreated(): bool
    {
        return $this->hasStatusCode(201);
    }
    
    public function isNoContent(): bool
    {
        return $this->hasStatusCode(204);
    }
    
    public function isClientError(): bool
    {
        $statusCode = $this->getStatusCode();
        return $statusCode >= 400 && $statusCode < 500;
    }
    
    public function isServerError(): bool
    {
        $statusCode = $this->getStatusCode();
        return $statusCode >= 500 && $statusCode < 600;
    }
    
    public function hasStatusCode(int $statusCode): bool
    {
        return $this->getStatusCode() === $statusCode;
    }
    
    public function getRawBody(): string
    {
        return (string)$this->httpResponse->getBody();
    }
    
    public function isEmpty(): bool
    {
        return in_array($this->getRawBody(), ['', '0'], true);
    }
    
    public function isPaginated(): bool
    {
        $json = $this->getDecodedBody();
        return is_array($json) && isset($json['pagination']);
    }
    
    public function hasResults(): bool
    {
        $json = $this->getDecodedBody();
        return is_array($json) && isset($json['results']);
    }
    
    public function hasData(): bool
    {
        $json = $this->getDecodedBody();

        // Check for direct data property
        if (is_array($json) && isset($json['data'])) {
            return true;
        }

        // Check if the response itself is data (single object or array)
        return !empty($json);
    }
    
    public function getHeaderValue(string $name): ?string
    {
        $headers = $this->getHeader($name);
        return !empty($headers) ? $headers[0] : null;
    }
    
    private function getDecodedBody(): mixed
    {
        if ($this->bodyDecoded) {
            return $this->decodedBody;
        }

        $body = $this->getRawBody();

        if ($body === '' || $body === '0') {
            throw new ApiException(
                'Response body is empty.',
                0,
                'empty_response',
                $this->httpResponse->getStatusCode(),
                null
            );
        }

        $json = json_decode($body, true); // Decode as array

        // Handle JSON decoding errors with detailed information
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ApiException(
                'Failed to decode JSON response: ' . json_last_error_msg(),
                json_last_error(),
                'json_decode_error',
                $this->httpResponse->getStatusCode(),
                ['raw_body' => $body]
            );
        }

        $this->decodedBody = $json;
        $this->bodyDecoded = true;

        return $this->decodedBody;
    }
    
    private function mapToModel(mixed $json, string $property): mixed
    {
        if ($this->model === null || !is_string($this->model) || !class_exists($this->model)) {
            throw new ApiException(
                "Model class '{$this->model}' does not exist.",
                0,
                'model_not_found',
                $this->httpResponse->getStatusCode(),
                ['model' => $this->model]
            );
        }

        // Handle array of items directly (no wrapper)
        if (is_array($json) && $this->isSequentialArray($json)) {
            return $this->mapArrayToModels($json);
        }

        // Handle array with specific property (results, data)
        if (is_array($json) && isset($json[$property])) {
            $data = $json[$property];

            // Handle empty results - return empty array instead of trying to create models
            if (is_array($data) && empty($data)) {
                return [];
            }

            // Handle array of items
            if (is_array($data) && $this->isSequentialArray($data)) {
                return $this->mapArrayToModels($data);
            }

            // Handle single item as associative array
            if (is_array($data) && !$this->isSequentialArray($data)) {
                return $this->createModelInstance($data);
            }
        }

        // Handle single object without wrapper (direct model response)
        if (is_array($json) && !$this->isSequentialArray($json)) {
            return $this->createModelInstance($json);
        }

        // If we can't map to model, return original data
        return $json;
    }
    
    private function isSequentialArray(array $array): bool
    {
        return array_keys($array) === range(0, count($array) - 1);
    }
    
    private function mapArrayToModels(array $data): array
    {
        $result = [];
        foreach ($data as $item) {
            if (is_array($item)) {
                $result[] = $this->createModelInstance($item);
            }
        }
        return $result;
    }
    
    private function createModelInstance(array $data): mixed
    {
        try {
            return new $this->model($data);
        } catch (Throwable $e) {
            throw new ApiException(
                "Failed to create model instance '{$this->model}': " . $e->getMessage(),
                0,
                'model_creation_error',
                $this->httpResponse->getStatusCode(),
                [
                    'model' => $this->model,
                    'data' => $data,
                    'error' => $e->getMessage()
                ]
            );
        }
    }
}
