<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\AuditRuleId;
use OpusDNS\Client\Serializer;

final readonly class AuditFinding implements ApiModel
{
    /**
     * @param AuditRuleId|string $rule `AuditRule.id` of the rule that found it.
     * @param string|null $downgradedFrom The rule's own severity, when lowered to info because the zone does not
     *     serve it.
     * @param string $entity zone | domain
     * @param bool $managed OpusDNS-managed, so the concierge can change it.
     * @param string $severity critical | warning | info
     */
    public function __construct(
        public AuditRuleId|string $rule,
        public ?string $downgradedFrom = null,
        public string $entity = '',
        public ?string $evidence = null,
        public bool $managed = false,
        public string $name = '',
        public ?string $registrar = null,
        public string $severity = '',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            rule: AuditRuleId::tryFrom($data['rule']) ?? $data['rule'],
            downgradedFrom: $data['downgraded_from'] ?? null,
            entity: $data['entity'] ?? '',
            evidence: $data['evidence'] ?? null,
            managed: $data['managed'] ?? false,
            name: $data['name'] ?? '',
            registrar: $data['registrar'] ?? null,
            severity: $data['severity'] ?? '',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'rule' => $this->rule,
            'downgraded_from' => $this->downgradedFrom,
            'entity' => $this->entity,
            'evidence' => $this->evidence,
            'managed' => $this->managed,
            'name' => $this->name,
            'registrar' => $this->registrar,
            'severity' => $this->severity,
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
