<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardLogEvent implements ApiModel
{
    /**
     * @param int $code Event status code
     * @param \DateTimeImmutable $created Timestamp when the event occurred
     * @param string $id Event ID
     * @param string $local ImprovMX server that processed the event
     * @param string $message Event message
     * @param string $server Server that processed the event
     * @param string $status Event status (QUEUED, DELIVERED, REFUSED, SOFT-BOUNCE, HARD-BOUNCE)
     */
    public function __construct(
        public int $code,
        public \DateTimeImmutable $created,
        public string $id,
        public string $local,
        public string $message,
        public string $server,
        public string $status,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            code: $data['code'],
            created: new \DateTimeImmutable($data['created']),
            id: $data['id'],
            local: $data['local'],
            message: $data['message'],
            server: $data['server'],
            status: $data['status'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'code' => $this->code,
            'created' => $this->created,
            'id' => $this->id,
            'local' => $this->local,
            'message' => $this->message,
            'server' => $this->server,
            'status' => $this->status,
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
