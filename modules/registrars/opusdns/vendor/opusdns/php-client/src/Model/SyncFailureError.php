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
 * Why the domain could not be synced, as an RFC 9457 problem with OpusDNS's code.
 */
final class SyncFailureError implements ApiModel
{
    /**
     * @param string $code Machine-readable reason, such as `ERROR_REGISTRAR_DOMAIN_NOT_FOUND`
     * @param string $detail What went wrong, as a sentence
     * @param bool $retryable True if a later sync may succeed on its own; false if the cause has to be fixed first
     * @param int $status HTTP status this failure would have as a request of its own
     * @param string $title Short summary of the problem type
     * @param string $type Problem type, derived from code
     * @param RegistrarError|null $registrarError The error in the registrar's own terms, for people and the
     *     registrar's support; null if it sent none. Its format differs per registrar: branch on `code`, not on this
     */
    public function __construct(
        public readonly string $code,
        public readonly string $detail,
        public readonly bool $retryable,
        public readonly int $status,
        public readonly string $title,
        public readonly string $type,
        public readonly ?RegistrarError $registrarError = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            code: $data['code'],
            detail: $data['detail'],
            retryable: $data['retryable'],
            status: $data['status'],
            title: $data['title'],
            type: $data['type'],
            registrarError: isset($data['registrar_error']) ? RegistrarError::fromArray($data['registrar_error']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'code' => $this->code,
            'detail' => $this->detail,
            'retryable' => $this->retryable,
            'status' => $this->status,
            'title' => $this->title,
            'type' => $this->type,
            'registrar_error' => $this->registrarError,
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
