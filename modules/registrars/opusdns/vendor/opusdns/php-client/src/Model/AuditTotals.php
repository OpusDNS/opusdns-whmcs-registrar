<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class AuditTotals implements ApiModel
{
    /**
     * @param int $scansChecked Domains with a security scan (TLS, HSTS, DNSSEC).
     */
    public function __construct(
        public readonly int $critical = 0,
        public readonly int $domainsChecked = 0,
        public readonly int $findings = 0,
        public readonly int $info = 0,
        public readonly int $scansChecked = 0,
        public readonly int $warning = 0,
        public readonly int $zonesChecked = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            critical: $data['critical'] ?? 0,
            domainsChecked: $data['domains_checked'] ?? 0,
            findings: $data['findings'] ?? 0,
            info: $data['info'] ?? 0,
            scansChecked: $data['scans_checked'] ?? 0,
            warning: $data['warning'] ?? 0,
            zonesChecked: $data['zones_checked'] ?? 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'critical' => $this->critical,
            'domains_checked' => $this->domainsChecked,
            'findings' => $this->findings,
            'info' => $this->info,
            'scans_checked' => $this->scansChecked,
            'warning' => $this->warning,
            'zones_checked' => $this->zonesChecked,
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
