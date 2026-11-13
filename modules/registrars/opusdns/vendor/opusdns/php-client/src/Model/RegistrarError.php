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
 * The error as the registrar itself reported it. A member the registrar didn't send is null.
 */
final class RegistrarError implements ApiModel
{
    /**
     * @param string|null $code The registrar's own result code, in its format
     * @param string|null $message The registrar's own message
     * @param string|null $reference The registrar's transaction or request ID, for its support. Not every registrar
     *     sends one
     */
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $message = null,
        public readonly ?string $reference = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            code: $data['code'] ?? null,
            message: $data['message'] ?? null,
            reference: $data['reference'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'code' => $this->code,
            'message' => $this->message,
            'reference' => $this->reference,
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
