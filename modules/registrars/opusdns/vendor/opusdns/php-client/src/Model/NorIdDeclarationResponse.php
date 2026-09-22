<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\NorIdDeclarationStatus;
use OpusDNS\Client\Serializer;

final readonly class NorIdDeclarationResponse implements ApiModel
{
    /**
     * @param string $declarationContractText The fixed Norwegian declaration contract text
     * @param string $declarationHeader The fixed Norwegian declaration header
     * @param string $declarationIntroduction The fixed Norwegian declaration introduction
     * @param string $declarationVersion The applicant declaration text version
     * @param string $domainName The domain name the declaration applies to
     * @param \DateTimeImmutable $expiresOn When the unconfirmed create request expires
     * @param string $organizationId The organization that owns the domain; used to brand the page TypeID prefix:
     *     organization.
     * @param NorIdDeclarationStatus|string $status The declaration status
     * @param string $subscriberName The domain name subscriber (registrant)
     * @param string|null $identityType The subscriber identity type
     * @param string|null $identityValue The subscriber identity (organization number or Person-ID)
     */
    public function __construct(
        public string $declarationContractText,
        public string $declarationHeader,
        public string $declarationIntroduction,
        public string $declarationVersion,
        public string $domainName,
        public \DateTimeImmutable $expiresOn,
        public string $organizationId,
        public NorIdDeclarationStatus|string $status,
        public string $subscriberName,
        public ?string $identityType = null,
        public ?string $identityValue = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            declarationContractText: $data['declaration_contract_text'],
            declarationHeader: $data['declaration_header'],
            declarationIntroduction: $data['declaration_introduction'],
            declarationVersion: $data['declaration_version'],
            domainName: $data['domain_name'],
            expiresOn: new \DateTimeImmutable($data['expires_on']),
            organizationId: $data['organization_id'],
            status: NorIdDeclarationStatus::tryFrom($data['status']) ?? $data['status'],
            subscriberName: $data['subscriber_name'],
            identityType: $data['identity_type'] ?? null,
            identityValue: $data['identity_value'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'declaration_contract_text' => $this->declarationContractText,
            'declaration_header' => $this->declarationHeader,
            'declaration_introduction' => $this->declarationIntroduction,
            'declaration_version' => $this->declarationVersion,
            'domain_name' => $this->domainName,
            'expires_on' => $this->expiresOn,
            'organization_id' => $this->organizationId,
            'status' => $this->status,
            'subscriber_name' => $this->subscriberName,
            'identity_type' => $this->identityType,
            'identity_value' => $this->identityValue,
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
