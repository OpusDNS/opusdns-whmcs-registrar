<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Enum;

/**
 * Customer-facing document class. Orthogonal to `InvoiceResponseType`: prepaid-credit invoices are
 * receipts, everything else billable is an invoice. Documents billing classifies as neither are never
 * returned.
 */
enum InvoiceDocumentType: string
{
    case INVOICE = 'invoice';
    case RECEIPT = 'receipt';
}
