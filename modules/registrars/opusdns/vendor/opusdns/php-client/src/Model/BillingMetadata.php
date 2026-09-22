<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class BillingMetadata implements ApiModel
{
    /**
     * @param string|null $billingModel Payment terms for the organization.
     * @param int|null $creditLimit Credit limit for the organization.
     * @param int|null $customerNumber Customer account number for the organization.
     */
    public function __construct(
        public ?string $billingModel = null,
        public ?int $creditLimit = null,
        public ?int $customerNumber = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            billingModel: $data['billing_model'] ?? null,
            creditLimit: $data['credit_limit'] ?? null,
            customerNumber: $data['customer_number'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'billing_model' => $this->billingModel,
            'credit_limit' => $this->creditLimit,
            'customer_number' => $this->customerNumber,
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
