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
final readonly class ApiDomainTldSpecificLtModelsRequestAuthcodeResponse implements ApiModel
{
    /**
     * @param string $name The domain name that had the auth code requested
     * @param bool $success Whether the request had a successful result from DOMREG
     * @param string|null $authCode The auth code returned by DOMREG
     * @param \DateTimeImmutable|null $authCodeExpiresOn The expiry date of the auth code
     * @param string|null $detail Additional information about the result in case of failure
     */
    public function __construct(
        public string $name,
        public bool $success,
        public ?string $authCode = null,
        public ?\DateTimeImmutable $authCodeExpiresOn = null,
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
            authCode: $data['auth_code'] ?? null,
            authCodeExpiresOn: isset($data['auth_code_expires_on']) ? new \DateTimeImmutable($data['auth_code_expires_on']) : null,
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
            'auth_code' => $this->authCode,
            'auth_code_expires_on' => $this->authCodeExpiresOn,
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
