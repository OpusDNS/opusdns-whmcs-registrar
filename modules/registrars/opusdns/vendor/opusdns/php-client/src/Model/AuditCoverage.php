<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class AuditCoverage implements ApiModel
{
    /**
     * @param list<string> $notChecked What the audit could not cover, in English.
     * @param AuditSourceStatus|null $domainChecker The security scans.
     * @param AuditSourceStatus|null $index The portfolio index, a synced copy.
     * @param \DateTimeImmutable|null $oldestSync Oldest sync of the indexed records read.
     * @param AuditSourceStatus|null $opusdnsApi The live OpusDNS API.
     */
    public function __construct(
        public array $notChecked,
        public ?AuditSourceStatus $domainChecker = null,
        public ?AuditSourceStatus $index = null,
        public ?\DateTimeImmutable $newestSync = null,
        public ?\DateTimeImmutable $oldestSync = null,
        public ?AuditSourceStatus $opusdnsApi = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            notChecked: $data['not_checked'],
            domainChecker: isset($data['domain_checker']) ? AuditSourceStatus::fromArray($data['domain_checker']) : null,
            index: isset($data['index']) ? AuditSourceStatus::fromArray($data['index']) : null,
            newestSync: isset($data['newest_sync']) ? new \DateTimeImmutable($data['newest_sync']) : null,
            oldestSync: isset($data['oldest_sync']) ? new \DateTimeImmutable($data['oldest_sync']) : null,
            opusdnsApi: isset($data['opusdns_api']) ? AuditSourceStatus::fromArray($data['opusdns_api']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'not_checked' => $this->notChecked,
            'domain_checker' => $this->domainChecker,
            'index' => $this->index,
            'newest_sync' => $this->newestSync,
            'oldest_sync' => $this->oldestSync,
            'opusdns_api' => $this->opusdnsApi,
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
