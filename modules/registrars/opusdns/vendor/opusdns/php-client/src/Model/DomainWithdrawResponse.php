<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainWithdrawResponse implements ApiModel
{
    /**
     * @param string $name The domain name that was withdrawn
     * @param bool $success Whether the withdraw operation was successful
     * @param string|null $detail Why the withdraw did not succeed
     */
    public function __construct(
        public string $name,
        public bool $success,
        public ?string $detail = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            success: $data['success'],
            detail: $data['detail'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'success' => $this->success,
            'detail' => $this->detail,
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
