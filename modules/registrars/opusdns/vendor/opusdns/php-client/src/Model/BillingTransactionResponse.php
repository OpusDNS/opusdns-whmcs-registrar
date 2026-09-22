<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\BillingTransactionAction;
use OpusDNS\Client\Enum\BillingTransactionProductType;
use OpusDNS\Client\Enum\BillingTransactionStatus;
use OpusDNS\Client\Enum\Currency;
use OpusDNS\Client\Serializer;

final readonly class BillingTransactionResponse implements ApiModel
{
    /**
     * @param BillingTransactionAction|string $action The action performed in the transaction
     * @param string $amount The amount of the transaction including VAT
     * @param string $price The price of the product without sales tax
     * @param BillingTransactionProductType|string $productType The type of product
     * @param string $taxAmount The tax amount of the transaction
     * @param string $taxRate The tax rate of the transaction
     * @param string $volume The quantity the transaction covers, expressed in `unit` (e.g. 1 for a one-year domain
     *     renewal)
     * @param string|null $billingTransactionId TypeID prefix: billing_transaction.
     * @param \DateTimeImmutable|null $completedOn The date/time the transaction completed
     * @param \DateTimeImmutable|null $createdOn The date/time the transaction was created
     * @param Currency|string|null $currency The currency of the transaction
     * @param string|null $productReference The reference of the product
     * @param BillingTransactionStatus|string $status The status of the transaction
     * @param string|null $unit The unit for `volume` (e.g. 'y' for years when renewing a domain); null when not
     *     applicable
     * @param \DateTimeImmutable|null $updatedOn The date/time the transaction was updated
     */
    public function __construct(
        public BillingTransactionAction|string $action,
        public string $amount,
        public string $price,
        public BillingTransactionProductType|string $productType,
        public string $taxAmount,
        public string $taxRate,
        public string $volume,
        public ?string $billingTransactionId = null,
        public ?\DateTimeImmutable $completedOn = null,
        public ?\DateTimeImmutable $createdOn = null,
        public Currency|string|null $currency = null,
        public ?string $productReference = null,
        public BillingTransactionStatus|string $status = BillingTransactionStatus::PENDING,
        public ?string $unit = null,
        public ?\DateTimeImmutable $updatedOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            action: BillingTransactionAction::tryFrom($data['action']) ?? $data['action'],
            amount: $data['amount'],
            price: $data['price'],
            productType: BillingTransactionProductType::tryFrom($data['product_type']) ?? $data['product_type'],
            taxAmount: $data['tax_amount'],
            taxRate: $data['tax_rate'],
            volume: $data['volume'],
            billingTransactionId: $data['billing_transaction_id'] ?? null,
            completedOn: isset($data['completed_on']) ? new \DateTimeImmutable($data['completed_on']) : null,
            createdOn: isset($data['created_on']) ? new \DateTimeImmutable($data['created_on']) : null,
            currency: isset($data['currency']) ? Currency::tryFrom($data['currency']) ?? $data['currency'] : null,
            productReference: $data['product_reference'] ?? null,
            status: isset($data['status']) ? BillingTransactionStatus::tryFrom($data['status']) ?? $data['status'] : BillingTransactionStatus::PENDING,
            unit: $data['unit'] ?? null,
            updatedOn: isset($data['updated_on']) ? new \DateTimeImmutable($data['updated_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'action' => $this->action,
            'amount' => $this->amount,
            'price' => $this->price,
            'product_type' => $this->productType,
            'tax_amount' => $this->taxAmount,
            'tax_rate' => $this->taxRate,
            'volume' => $this->volume,
            'billing_transaction_id' => $this->billingTransactionId,
            'completed_on' => $this->completedOn,
            'created_on' => $this->createdOn,
            'currency' => $this->currency,
            'product_reference' => $this->productReference,
            'status' => $this->status,
            'unit' => $this->unit,
            'updated_on' => $this->updatedOn,
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
