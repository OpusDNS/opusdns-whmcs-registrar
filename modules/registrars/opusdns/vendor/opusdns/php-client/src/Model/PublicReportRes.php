<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ReportStatus;
use OpusDNS\Client\Enum\ReportTriggerType;
use OpusDNS\Client\Enum\ReportType;
use OpusDNS\Client\Serializer;

final readonly class PublicReportRes implements ApiModel
{
    /**
     * @param string $organizationId TypeID prefix: organization.
     * @param string $reportId TypeID prefix: report.
     */
    public function __construct(
        public \DateTimeImmutable $createdOn,
        public string $organizationId,
        public string $reportId,
        public ReportType|string $reportType,
        public ReportStatus|string $status,
        public ReportTriggerType|string $triggerType,
        public \DateTimeImmutable $updatedOn,
        public ?int $fileSizeBytes = null,
        public ?\DateTimeImmutable $generatedOn = null,
        public ?int $recordCount = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            organizationId: $data['organization_id'],
            reportId: $data['report_id'],
            reportType: ReportType::tryFrom($data['report_type']) ?? $data['report_type'],
            status: ReportStatus::tryFrom($data['status']) ?? $data['status'],
            triggerType: ReportTriggerType::tryFrom($data['trigger_type']) ?? $data['trigger_type'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            fileSizeBytes: $data['file_size_bytes'] ?? null,
            generatedOn: isset($data['generated_on']) ? new \DateTimeImmutable($data['generated_on']) : null,
            recordCount: $data['record_count'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'organization_id' => $this->organizationId,
            'report_id' => $this->reportId,
            'report_type' => $this->reportType,
            'status' => $this->status,
            'trigger_type' => $this->triggerType,
            'updated_on' => $this->updatedOn,
            'file_size_bytes' => $this->fileSizeBytes,
            'generated_on' => $this->generatedOn,
            'record_count' => $this->recordCount,
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
