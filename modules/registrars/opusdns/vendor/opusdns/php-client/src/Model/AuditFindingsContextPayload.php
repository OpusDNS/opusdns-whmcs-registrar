<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class AuditFindingsContextPayload implements ApiModel
{
    /**
     * @param list<AuditFinding> $findings Most severe first.
     * @param list<AuditRule> $rules One entry per rule that found something. A rule newer than this API is left out
     *     with its findings; `totals` still counts them.
     * @param bool $complete False when a source stopped early or failed, or RAS did not say: the findings are a
     *     lower bound.
     * @param string $schema portfolio_audit/v1. Any other version arrives with only this field set.
     * @param string $scope zones | domains | security | all
     * @param bool $truncated True when `findings` was cut to fit the store; that cut leaves `totals` and `rules`
     *     whole.
     */
    public function __construct(
        public AuditCoverage $coverage,
        public AuditFilters $filters,
        public array $findings,
        public array $rules,
        public AuditTotals $totals,
        public bool $complete = false,
        public ?\DateTimeImmutable $generatedAt = null,
        public string $schema = '',
        public string $scope = '',
        public bool $truncated = false,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            coverage: AuditCoverage::fromArray($data['coverage']),
            filters: AuditFilters::fromArray($data['filters']),
            findings: array_map(static fn (array $item): AuditFinding => AuditFinding::fromArray($item), $data['findings']),
            rules: array_map(static fn (array $item): AuditRule => AuditRule::fromArray($item), $data['rules']),
            totals: AuditTotals::fromArray($data['totals']),
            complete: $data['complete'] ?? false,
            generatedAt: isset($data['generated_at']) ? new \DateTimeImmutable($data['generated_at']) : null,
            schema: $data['schema'] ?? '',
            scope: $data['scope'] ?? '',
            truncated: $data['truncated'] ?? false,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'coverage' => $this->coverage,
            'filters' => $this->filters,
            'findings' => $this->findings,
            'rules' => $this->rules,
            'totals' => $this->totals,
            'complete' => $this->complete,
            'generated_at' => $this->generatedAt,
            'schema' => $this->schema,
            'scope' => $this->scope,
            'truncated' => $this->truncated,
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
