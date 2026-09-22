<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ComplianceStatus;
use OpusDNS\Client\Serializer;

final readonly class ParkingResponse implements ApiModel
{
    /**
     * @param \DateTimeImmutable $createdOn When the parking entry was created
     * @param string $domain The domain name for the parking ad
     * @param bool $enabled Whether parking is enabled
     * @param string $parkingId Unique identifier for the parking entry TypeID prefix: parking.
     * @param \DateTimeImmutable $updatedOn When the parking entry was last updated
     * @param ComplianceStatus|string|null $complianceStatus The compliance status of the parking ad
     * @param string|null $contentLanguage The primary language code for the ad content
     * @param string|null $contentUrl The content URL for approved parking ads
     * @param string|null $note Additional notes about the parking ad
     */
    public function __construct(
        public \DateTimeImmutable $createdOn,
        public string $domain,
        public bool $enabled,
        public string $parkingId,
        public \DateTimeImmutable $updatedOn,
        public ComplianceStatus|string|null $complianceStatus = null,
        public ?string $contentLanguage = null,
        public ?string $contentUrl = null,
        public ?string $note = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            domain: $data['domain'],
            enabled: $data['enabled'],
            parkingId: $data['parking_id'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            complianceStatus: isset($data['compliance_status']) ? ComplianceStatus::tryFrom($data['compliance_status']) ?? $data['compliance_status'] : null,
            contentLanguage: $data['content_language'] ?? null,
            contentUrl: $data['content_url'] ?? null,
            note: $data['note'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'domain' => $this->domain,
            'enabled' => $this->enabled,
            'parking_id' => $this->parkingId,
            'updated_on' => $this->updatedOn,
            'compliance_status' => $this->complianceStatus,
            'content_language' => $this->contentLanguage,
            'content_url' => $this->contentUrl,
            'note' => $this->note,
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
