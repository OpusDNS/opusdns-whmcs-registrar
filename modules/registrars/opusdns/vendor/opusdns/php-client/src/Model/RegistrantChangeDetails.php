<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\RegistrantChangeConfirmationMethod;
use OpusDNS\Client\Enum\RegistrantChangeStatus;
use OpusDNS\Client\Serializer;

final readonly class RegistrantChangeDetails implements ApiModel
{
    /**
     * @param string $newRegistrantId TypeID prefix: contact.
     * @param string $priorRegistrantId TypeID prefix: contact.
     * @param string $registrantChangeId TypeID prefix: registrant_change.
     */
    public function __construct(
        public string $newRegistrantId,
        public string $priorRegistrantId,
        public string $registrantChangeId,
        public RegistrantChangeStatus|string $status,
        public ?\DateTimeImmutable $confirmationDeadline = null,
        public RegistrantChangeConfirmationMethod|string|null $confirmationMethod = null,
        public string $detailType = 'registrant_change',
        public ?string $notificationType = null,
        public bool $transferLockOptOut = false,
        public ?\DateTimeImmutable $transferLockUntil = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            newRegistrantId: $data['new_registrant_id'],
            priorRegistrantId: $data['prior_registrant_id'],
            registrantChangeId: $data['registrant_change_id'],
            status: RegistrantChangeStatus::tryFrom($data['status']) ?? $data['status'],
            confirmationDeadline: isset($data['confirmation_deadline']) ? new \DateTimeImmutable($data['confirmation_deadline']) : null,
            confirmationMethod: isset($data['confirmation_method']) ? RegistrantChangeConfirmationMethod::tryFrom($data['confirmation_method']) ?? $data['confirmation_method'] : null,
            detailType: $data['detail_type'] ?? 'registrant_change',
            notificationType: $data['notification_type'] ?? null,
            transferLockOptOut: $data['transfer_lock_opt_out'] ?? false,
            transferLockUntil: isset($data['transfer_lock_until']) ? new \DateTimeImmutable($data['transfer_lock_until']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'new_registrant_id' => $this->newRegistrantId,
            'prior_registrant_id' => $this->priorRegistrantId,
            'registrant_change_id' => $this->registrantChangeId,
            'status' => $this->status,
            'confirmation_deadline' => $this->confirmationDeadline,
            'confirmation_method' => $this->confirmationMethod,
            'detail_type' => $this->detailType,
            'notification_type' => $this->notificationType,
            'transfer_lock_opt_out' => $this->transferLockOptOut,
            'transfer_lock_until' => $this->transferLockUntil,
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
