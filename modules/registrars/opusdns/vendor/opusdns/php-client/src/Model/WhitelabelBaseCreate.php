<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * Create the base tier: served on a managed subdomain composed from `label`.
 */
final readonly class WhitelabelBaseCreate implements ApiModel
{
    /**
     * @param string $label Managed-subdomain label; composed into app.<label>.<base-tier suffix> /
     *     auth.<label>.<suffix>
     * @param Period $period Billing period; offered: 1 month or 1 year
     * @param string $tier Tier discriminator; base = served on a managed subdomain of an OpusDNS-owned zone
     */
    public function __construct(
        public string $label,
        public Period $period,
        public string $tier = 'base',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            label: $data['label'],
            period: Period::fromArray($data['period']),
            tier: $data['tier'] ?? 'base',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'label' => $this->label,
            'period' => $this->period,
            'tier' => $this->tier,
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
