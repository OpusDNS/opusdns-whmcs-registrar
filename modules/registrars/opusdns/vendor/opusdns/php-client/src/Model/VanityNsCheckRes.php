<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\VanityNameserverSetStatusDTO;
use OpusDNS\Client\Serializer;

final readonly class VanityNsCheckRes implements ApiModel
{
    /**
     * @param string $parentDomainName Parent domain of the set's vanity NS hostnames
     * @param string $setId The diagnosed set TypeID prefix: vns.
     * @param VanityNameserverSetStatusDTO|string $status Lifecycle status of the set at check time
     * @param VanityNsCheckSummaryDTO $summary Synthesized overall verdict
     * @param list<VanityNsCheckResultDTO>|null $checks Individual diagnostic checks
     */
    public function __construct(
        public string $parentDomainName,
        public string $setId,
        public VanityNameserverSetStatusDTO|string $status,
        public VanityNsCheckSummaryDTO $summary,
        public ?array $checks = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            parentDomainName: $data['parent_domain_name'],
            setId: $data['set_id'],
            status: VanityNameserverSetStatusDTO::tryFrom($data['status']) ?? $data['status'],
            summary: VanityNsCheckSummaryDTO::fromArray($data['summary']),
            checks: isset($data['checks']) ? array_map(static fn (array $item): VanityNsCheckResultDTO => VanityNsCheckResultDTO::fromArray($item), $data['checks']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'parent_domain_name' => $this->parentDomainName,
            'set_id' => $this->setId,
            'status' => $this->status,
            'summary' => $this->summary,
            'checks' => $this->checks,
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
