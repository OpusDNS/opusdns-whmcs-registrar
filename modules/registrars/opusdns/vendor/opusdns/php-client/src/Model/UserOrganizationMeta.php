<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\Currency;
use OpusDNS\Client\Serializer;

final readonly class UserOrganizationMeta implements ApiModel
{
    /**
     * @param Currency|string|null $currency Currency used by the user's organization.
     * @param string|null $parentOrganizationId ID of the parent organization, if any.
     */
    public function __construct(
        public Currency|string|null $currency = null,
        public ?string $parentOrganizationId = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            currency: isset($data['currency']) ? Currency::tryFrom($data['currency']) ?? $data['currency'] : null,
            parentOrganizationId: $data['parent_organization_id'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'currency' => $this->currency,
            'parent_organization_id' => $this->parentOrganizationId,
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
