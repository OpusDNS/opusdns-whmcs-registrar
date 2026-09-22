<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ReportType;
use OpusDNS\Client\Serializer;

final readonly class CreateReportReq implements ApiModel
{
    public function __construct(
        public ?string $registrarCredentialId = null,
        public ReportType|string $reportType = ReportType::DOMAIN_INVENTORY,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            registrarCredentialId: $data['registrar_credential_id'] ?? null,
            reportType: isset($data['report_type']) ? ReportType::tryFrom($data['report_type']) ?? $data['report_type'] : ReportType::DOMAIN_INVENTORY,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'registrar_credential_id' => $this->registrarCredentialId,
            'report_type' => $this->reportType,
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
