<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\Currency;
use OpusDNS\Client\Enum\InvoiceDocumentType;
use OpusDNS\Client\Enum\InvoiceResponsePaymentStatus;
use OpusDNS\Client\Enum\InvoiceResponseStatus;
use OpusDNS\Client\Enum\InvoiceResponseType;
use OpusDNS\Client\Serializer;

final readonly class InvoiceResponse implements ApiModel
{
    /**
     * @param string $amount Total invoice amount
     * @param Currency|string $currency Invoice currency
     * @param InvoiceDocumentType|string $documentType Customer-facing document class
     * @param string $externalId Lago ID (external) for this invoice
     * @param string $feesAmount Fees amount
     * @param InvoiceResponseType|string $invoiceType Invoice type
     * @param \DateTimeImmutable $issuingDate Invoice issuing date
     * @param string $number Invoice number
     * @param \DateTimeImmutable $paymentDueDate Payment due date
     * @param bool $paymentOverdue Whether payment is overdue
     * @param InvoiceResponsePaymentStatus|string $paymentStatus Payment status
     * @param InvoiceResponseStatus|string $status Invoice status
     * @param string $taxesAmount Taxes amount
     * @param string|null $fileUrl URL to invoice PDF file
     */
    public function __construct(
        public string $amount,
        public Currency|string $currency,
        public InvoiceDocumentType|string $documentType,
        public string $externalId,
        public string $feesAmount,
        public InvoiceResponseType|string $invoiceType,
        public \DateTimeImmutable $issuingDate,
        public string $number,
        public \DateTimeImmutable $paymentDueDate,
        public bool $paymentOverdue,
        public InvoiceResponsePaymentStatus|string $paymentStatus,
        public InvoiceResponseStatus|string $status,
        public string $taxesAmount,
        public ?string $fileUrl = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            amount: $data['amount'],
            currency: Currency::tryFrom($data['currency']) ?? $data['currency'],
            documentType: InvoiceDocumentType::tryFrom($data['document_type']) ?? $data['document_type'],
            externalId: $data['external_id'],
            feesAmount: $data['fees_amount'],
            invoiceType: InvoiceResponseType::tryFrom($data['invoice_type']) ?? $data['invoice_type'],
            issuingDate: new \DateTimeImmutable($data['issuing_date']),
            number: $data['number'],
            paymentDueDate: new \DateTimeImmutable($data['payment_due_date']),
            paymentOverdue: $data['payment_overdue'],
            paymentStatus: InvoiceResponsePaymentStatus::tryFrom($data['payment_status']) ?? $data['payment_status'],
            status: InvoiceResponseStatus::tryFrom($data['status']) ?? $data['status'],
            taxesAmount: $data['taxes_amount'],
            fileUrl: $data['file_url'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'amount' => $this->amount,
            'currency' => $this->currency,
            'document_type' => $this->documentType,
            'external_id' => $this->externalId,
            'fees_amount' => $this->feesAmount,
            'invoice_type' => $this->invoiceType,
            'issuing_date' => $this->issuingDate,
            'number' => $this->number,
            'payment_due_date' => $this->paymentDueDate,
            'payment_overdue' => $this->paymentOverdue,
            'payment_status' => $this->paymentStatus,
            'status' => $this->status,
            'taxes_amount' => $this->taxesAmount,
            'file_url' => $this->fileUrl,
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
