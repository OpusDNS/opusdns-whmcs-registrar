<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\EmailVerificationStatus;
use OpusDNS\Client\Enum\VerificationType;
use OpusDNS\Client\Serializer;

final readonly class ContactVerificationApiResponse implements ApiModel
{
    /**
     * @param string $token The token to verify the email address
     * @param VerificationType|string $type The type of verification: 'api' for retrieving token via API, 'email' for
     *     retrieving via email
     * @param \DateTimeImmutable|null $canceledOn The date the verification was cancelled
     * @param string|null $contactId The contact that is being verified TypeID prefix: contact.
     * @param string|null $contactVerificationId TypeID prefix: contact_verification.
     * @param \DateTimeImmutable|null $createdOn The date/time the entry was created on
     * @param EmailVerificationStatus|string $status Current status of the email verification
     * @param \DateTimeImmutable|null $updatedOn The date/time the entry was last updated on
     * @param \DateTimeImmutable|null $verifiedOn The date the verification was verified
     */
    public function __construct(
        public string $token,
        public VerificationType|string $type,
        public ?\DateTimeImmutable $canceledOn = null,
        public ?string $contactId = null,
        public ?string $contactVerificationId = null,
        public ?\DateTimeImmutable $createdOn = null,
        public EmailVerificationStatus|string $status = EmailVerificationStatus::PENDING,
        public ?\DateTimeImmutable $updatedOn = null,
        public ?\DateTimeImmutable $verifiedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            token: $data['token'],
            type: VerificationType::tryFrom($data['type']) ?? $data['type'],
            canceledOn: isset($data['canceled_on']) ? new \DateTimeImmutable($data['canceled_on']) : null,
            contactId: $data['contact_id'] ?? null,
            contactVerificationId: $data['contact_verification_id'] ?? null,
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            status: isset($data['status']) ? EmailVerificationStatus::tryFrom($data['status']) ?? $data['status'] : EmailVerificationStatus::PENDING,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
            verifiedOn: isset($data['verified_on']) ? new \DateTimeImmutable($data['verified_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'token' => $this->token,
            'type' => $this->type,
            'canceled_on' => $this->canceledOn,
            'contact_id' => $this->contactId,
            'contact_verification_id' => $this->contactVerificationId,
            'created_on' => $this->createdOn,
            'status' => $this->status,
            'updated_on' => $this->updatedOn,
            'verified_on' => $this->verifiedOn,
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
