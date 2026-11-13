<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class DomainAvailabilityError implements ApiModel
{
    /**
     * @param string $message Human-readable error message; the same sentence as detail when detail is set
     * @param int $status HTTP status code this error would have as a request of its own
     * @param string $title Short summary of the error type (RFC 9457)
     * @param string $type Error type: one of `validation_error`, `check_error`. Clients should treat an unknown type
     *     as check_error.
     * @param string|null $code Machine-readable validation error code: one of `ERROR_DOMAIN_NAME_INVALID`,
     *     `ERROR_TLD_IDN_NOT_SUPPORTED`, `ERROR_TLD_NOT_AVAILABLE`, `ERROR_DOMAIN_NOT_REGISTRABLE`,
     *     `ERROR_DOMAIN_EMPTY`, `ERROR_DOMAIN_INPUT_TOO_LONG`; more may be added. Absent for check_error.
     * @param string|null $detail Human-readable explanation of the code
     * @param list<DomainValidationIssue>|null $errors Every fixable problem with the name; only present with
     *     ERROR_DOMAIN_NAME_INVALID
     * @param string|null $tld The TLD the name was validated against, in ASCII (ACE) form, e.g. `xn--p1ai` for
     *     `рф`
     */
    public function __construct(
        public readonly string $message,
        public readonly int $status,
        public readonly string $title,
        public readonly string $type,
        public readonly ?string $code = null,
        public readonly ?string $detail = null,
        public readonly ?array $errors = null,
        public readonly ?string $tld = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            message: $data['message'],
            status: $data['status'],
            title: $data['title'],
            type: $data['type'],
            code: $data['code'] ?? null,
            detail: $data['detail'] ?? null,
            errors: isset($data['errors']) ? array_map(static fn (array $item): DomainValidationIssue => DomainValidationIssue::fromArray($item), $data['errors']) : null,
            tld: $data['tld'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'message' => $this->message,
            'status' => $this->status,
            'title' => $this->title,
            'type' => $this->type,
            'code' => $this->code,
            'detail' => $this->detail,
            'errors' => $this->errors,
            'tld' => $this->tld,
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
