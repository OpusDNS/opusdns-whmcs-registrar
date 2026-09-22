<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\VanityNsCheckConfidence;
use OpusDNS\Client\Enum\VanityNsCheckSeverity;
use OpusDNS\Client\Enum\VanityNsCheckSource;
use OpusDNS\Client\Enum\VanityNsCheckStatus;
use OpusDNS\Client\Serializer;

final readonly class VanityNsCheckResultDTO implements ApiModel
{
    /**
     * @param VanityNsCheckConfidence|string $confidence How authoritative the observation is
     * @param string $detail Customer-facing explanation of the result
     * @param string $id Stable identifier for the individual check
     * @param string $label Human-readable check name
     * @param VanityNsCheckSeverity|string $severity How much this check matters to the overall verdict
     * @param VanityNsCheckSource|string $source Where the observation came from
     * @param VanityNsCheckStatus|string $status Per-check verdict
     * @param array<string, mixed>|null $observed Structured observation (e.g. addresses seen, mismatches) for the
     *     customer
     * @param string|null $remediation Suggested next step when the check did not pass
     */
    public function __construct(
        public VanityNsCheckConfidence|string $confidence,
        public string $detail,
        public string $id,
        public string $label,
        public VanityNsCheckSeverity|string $severity,
        public VanityNsCheckSource|string $source,
        public VanityNsCheckStatus|string $status,
        public ?array $observed = null,
        public ?string $remediation = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            confidence: VanityNsCheckConfidence::tryFrom($data['confidence']) ?? $data['confidence'],
            detail: $data['detail'],
            id: $data['id'],
            label: $data['label'],
            severity: VanityNsCheckSeverity::tryFrom($data['severity']) ?? $data['severity'],
            source: VanityNsCheckSource::tryFrom($data['source']) ?? $data['source'],
            status: VanityNsCheckStatus::tryFrom($data['status']) ?? $data['status'],
            observed: isset($data['observed']) ? (array) $data['observed'] : null,
            remediation: $data['remediation'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'confidence' => $this->confidence,
            'detail' => $this->detail,
            'id' => $this->id,
            'label' => $this->label,
            'severity' => $this->severity,
            'source' => $this->source,
            'status' => $this->status,
            'observed' => $this->observed === null ? null : ($this->observed === [] ? new \stdClass() : $this->observed),
            'remediation' => $this->remediation,
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
