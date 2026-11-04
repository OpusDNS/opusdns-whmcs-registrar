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

final readonly class DomainRegistrantChangeResponse implements ApiModel
{
    /**
     * @param \DateTimeImmutable $createdOn When the request was created
     * @param string $domainId The ID of the domain TypeID prefix: domain.
     * @param bool $material Whether the name, organization or email of the registrant changes
     * @param string $newRegistrant The registrant after the change TypeID prefix: contact.
     * @param string $previousRegistrant The registrant before the change TypeID prefix: contact.
     * @param string $registrantChangeId The ID of the registrant change TypeID prefix: registrant_change.
     * @param RegistrantChangeStatus|string $status The status of the registrant change
     * @param bool $transferLockOptOut Whether the transfer lock after the change was opted out of
     * @param \DateTimeImmutable|null $confirmationDeadline When the request expires if not confirmed
     * @param RegistrantChangeConfirmationMethod|string|null $confirmationMethod How the change was confirmed, null when
     *     no confirmation applies
     * @param string|null $failureReason Why the registrant change failed
     * @param \DateTimeImmutable|null $transferLockUntil Until when the domain cannot be transferred to another
     *     registrar because of the change, null when no transfer lock applies
     */
    public function __construct(
        public \DateTimeImmutable $createdOn,
        public string $domainId,
        public bool $material,
        public string $newRegistrant,
        public string $previousRegistrant,
        public string $registrantChangeId,
        public RegistrantChangeStatus|string $status,
        public bool $transferLockOptOut,
        public ?\DateTimeImmutable $confirmationDeadline = null,
        public RegistrantChangeConfirmationMethod|string|null $confirmationMethod = null,
        public ?string $failureReason = null,
        public ?\DateTimeImmutable $transferLockUntil = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            domainId: $data['domain_id'],
            material: $data['material'],
            newRegistrant: $data['new_registrant'],
            previousRegistrant: $data['previous_registrant'],
            registrantChangeId: $data['registrant_change_id'],
            status: RegistrantChangeStatus::tryFrom($data['status']) ?? $data['status'],
            transferLockOptOut: $data['transfer_lock_opt_out'],
            confirmationDeadline: isset($data['confirmation_deadline']) ? new \DateTimeImmutable($data['confirmation_deadline']) : null,
            confirmationMethod: isset($data['confirmation_method']) ? RegistrantChangeConfirmationMethod::tryFrom($data['confirmation_method']) ?? $data['confirmation_method'] : null,
            failureReason: $data['failure_reason'] ?? null,
            transferLockUntil: isset($data['transfer_lock_until']) ? new \DateTimeImmutable($data['transfer_lock_until']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'domain_id' => $this->domainId,
            'material' => $this->material,
            'new_registrant' => $this->newRegistrant,
            'previous_registrant' => $this->previousRegistrant,
            'registrant_change_id' => $this->registrantChangeId,
            'status' => $this->status,
            'transfer_lock_opt_out' => $this->transferLockOptOut,
            'confirmation_deadline' => $this->confirmationDeadline,
            'confirmation_method' => $this->confirmationMethod,
            'failure_reason' => $this->failureReason,
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
