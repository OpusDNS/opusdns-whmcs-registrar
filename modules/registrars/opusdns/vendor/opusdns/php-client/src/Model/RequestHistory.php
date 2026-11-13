<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ExecutingEntity;
use OpusDNS\Client\Enum\HTTPMethod;
use OpusDNS\Client\Serializer;

final class RequestHistory implements ApiModel
{
    /**
     * @param string $clientIp Client IP address
     * @param float $duration Request duration in milliseconds
     * @param HTTPMethod|string $method HTTP method
     * @param string $path Request path
     * @param \DateTimeImmutable $requestCompletedAt Timestamp when the request completed
     * @param \DateTimeImmutable $requestStartedAt Timestamp when the request started
     * @param string $serverRequestId Unique ID of the request
     * @param int $statusCode HTTP status code
     * @param string|null $performedById ID of the actor who performed the request
     * @param ExecutingEntity|string|null $performedByType Type of the actor who performed the request
     * @param array<string, mixed>|null $requestBody Request body
     * @param array<string, mixed>|null $responseBody Response body
     */
    public function __construct(
        public readonly string $clientIp,
        public readonly float $duration,
        public readonly HTTPMethod|string $method,
        public readonly string $path,
        public readonly \DateTimeImmutable $requestCompletedAt,
        public readonly \DateTimeImmutable $requestStartedAt,
        public readonly string $serverRequestId,
        public readonly int $statusCode,
        public readonly ?string $performedById = null,
        public readonly ExecutingEntity|string|null $performedByType = null,
        public readonly ?array $requestBody = null,
        public readonly ?array $responseBody = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            clientIp: $data['client_ip'],
            duration: $data['duration'],
            method: HTTPMethod::tryFrom($data['method']) ?? $data['method'],
            path: $data['path'],
            requestCompletedAt: new \DateTimeImmutable($data['request_completed_at']),
            requestStartedAt: new \DateTimeImmutable($data['request_started_at']),
            serverRequestId: $data['server_request_id'],
            statusCode: $data['status_code'],
            performedById: $data['performed_by_id'] ?? null,
            performedByType: isset($data['performed_by_type']) ? ExecutingEntity::tryFrom($data['performed_by_type']) ?? $data['performed_by_type'] : null,
            requestBody: isset($data['request_body']) ? (array) $data['request_body'] : null,
            responseBody: isset($data['response_body']) ? (array) $data['response_body'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'client_ip' => $this->clientIp,
            'duration' => $this->duration,
            'method' => $this->method,
            'path' => $this->path,
            'request_completed_at' => $this->requestCompletedAt,
            'request_started_at' => $this->requestStartedAt,
            'server_request_id' => $this->serverRequestId,
            'status_code' => $this->statusCode,
            'performed_by_id' => $this->performedById,
            'performed_by_type' => $this->performedByType,
            'request_body' => $this->requestBody === null ? null : ($this->requestBody === [] ? new \stdClass() : $this->requestBody),
            'response_body' => $this->responseBody === null ? null : ($this->responseBody === [] ? new \stdClass() : $this->responseBody),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
