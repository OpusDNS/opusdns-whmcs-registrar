<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainContactType;
use OpusDNS\Client\Enum\LocalPresenceRequirementType;
use OpusDNS\Client\Serializer;

final readonly class LocalPresenceBase implements ApiModel
{
    /**
     * @param bool $required Whether a local presence is required to register and maintain a domain name
     * @param list<string>|null $eligibleCountries ISO 3166-1 Alpha-2 country code
     * @param list<AttributeCondition>|null $exemptions
     * @param list<LocalPresenceRequirementType|string>|null $requirement Type of local presence requirement
     * @param list<DomainContactType|string>|null $type Who must meet the requirement
     */
    public function __construct(
        public bool $required,
        public ?array $eligibleCountries = null,
        public ?array $exemptions = null,
        public ?array $requirement = null,
        public ?array $type = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            required: $data['required'],
            eligibleCountries: $data['eligible_countries'] ?? null,
            exemptions: isset($data['exemptions']) ? array_map(static fn (array $item): AttributeCondition => AttributeCondition::fromArray($item), $data['exemptions']) : null,
            requirement: isset($data['requirement']) ? array_map(static fn (string $item): LocalPresenceRequirementType|string => LocalPresenceRequirementType::tryFrom($item) ?? $item, $data['requirement']) : null,
            type: isset($data['type']) ? array_map(static fn (string $item): DomainContactType|string => DomainContactType::tryFrom($item) ?? $item, $data['type']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'required' => $this->required,
            'eligible_countries' => $this->eligibleCountries,
            'exemptions' => $this->exemptions,
            'requirement' => $this->requirement,
            'type' => $this->type,
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
