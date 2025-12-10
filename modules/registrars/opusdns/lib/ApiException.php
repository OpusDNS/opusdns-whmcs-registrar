<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS;

use Exception;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class ApiException extends Exception
{
    
    public function __construct(
        string $message = '',
        int $code = 0,
        public readonly ?string $type = null,
        public readonly ?int $statusCode = null,
        public readonly ?array $errors = null,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
    
    public static function fromResponse(
        ?ResponseInterface $response,
        ?Throwable $previous = null
    ): self {
        if (!$response) {
            return new self('Unknown error - no response available', 0, 'unknown_error', null, null, $previous);
        }

        $statusCode = $response->getStatusCode();
        $body = (string)$response->getBody();

        // Try to decode JSON error response
        $errorData = null;
        if ($body !== '' && $body !== '0') {
            $decoded = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $errorData = $decoded;
            }
        }

        // Extract error information
        $title = $errorData['title'] ?? 'HTTP Error';
        $detail = $errorData['detail'] ?? ($errorData['error'] ?? '');
        $type = $errorData['type'] ?? 'api-error';
        $errors = isset($errorData['errors']) && is_array($errorData['errors']) ? $errorData['errors'] : null;

        // Build comprehensive error message
        $message = $title;
        if (!empty($detail)) {
            $message .= ": {$detail}";
        }

        return new self($message, $statusCode, $type, $statusCode, $errors, $previous);
    }
    
    public function getType(): ?string
    {
        return $this->type;
    }
    
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }
    
    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
