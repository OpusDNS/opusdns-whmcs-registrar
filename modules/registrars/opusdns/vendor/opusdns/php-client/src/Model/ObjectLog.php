<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ExecutingEntity;
use OpusDNS\Client\Enum\ObjectEventType;
use OpusDNS\Client\Serializer;

final readonly class ObjectLog implements ApiModel
{
    /**
     * @param ObjectEventType|string $action Action performed
     * @param \DateTimeImmutable $createdOn Timestamp when the log was created
     * @param string $objectId ID of the object
     * @param string $objectLogId Unique ID of the log
     * @param string $objectType Type of the object
     * @param array<string, mixed>|null $details Changes made to the object
     * @param string|null $performedById ID of the actor who performed the action
     * @param ExecutingEntity|string|null $performedByType Type of the actor who performed the action
     * @param string|null $serverRequestId Server request ID
     */
    public function __construct(
        public ObjectEventType|string $action,
        public \DateTimeImmutable $createdOn,
        public string $objectId,
        public string $objectLogId,
        public string $objectType,
        public ?array $details = null,
        public ?string $performedById = null,
        public ExecutingEntity|string|null $performedByType = null,
        public ?string $serverRequestId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            action: ObjectEventType::tryFrom($data['action']) ?? $data['action'],
            createdOn: new \DateTimeImmutable($data['created_on']),
            objectId: $data['object_id'],
            objectLogId: $data['object_log_id'],
            objectType: $data['object_type'],
            details: isset($data['details']) ? (array) $data['details'] : null,
            performedById: $data['performed_by_id'] ?? null,
            performedByType: isset($data['performed_by_type']) ? ExecutingEntity::tryFrom($data['performed_by_type']) ?? $data['performed_by_type'] : null,
            serverRequestId: $data['server_request_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'action' => $this->action,
            'created_on' => $this->createdOn,
            'object_id' => $this->objectId,
            'object_log_id' => $this->objectLogId,
            'object_type' => $this->objectType,
            'details' => $this->details === null ? null : ($this->details === [] ? new \stdClass() : $this->details),
            'performed_by_id' => $this->performedById,
            'performed_by_type' => $this->performedByType,
            'server_request_id' => $this->serverRequestId,
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
