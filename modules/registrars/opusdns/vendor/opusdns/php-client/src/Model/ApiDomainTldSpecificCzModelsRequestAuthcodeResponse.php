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
 * RequestAuthcodeResponse
 */
final readonly class ApiDomainTldSpecificCzModelsRequestAuthcodeResponse implements ApiModel
{
    /**
     * @param string $name The domain name that had the auth code requested
     * @param bool $success Whether the request had a successful result from CZ.NIC
     * @param string|null $detail Additional information about the result in case of failure
     * @param list<string>|null $recipients Masked email addresses CZ.NIC sent the auth code to, when the registry
     *     discloses them
     */
    public function __construct(
        public string $name,
        public bool $success,
        public ?string $detail = null,
        public ?array $recipients = null,
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
            recipients: $data['recipients'] ?? null,
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
            'recipients' => $this->recipients,
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
