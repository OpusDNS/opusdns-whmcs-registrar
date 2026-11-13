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
 * What a `marketplace_domain_purchase` item delivers: the transfer auth code.
 */
final class MarketplaceDomainPurchaseDelivery implements ApiModel
{
    /**
     * @param string $authCode The transfer auth code. Use it at the registrar you transfer the domain to
     * @param \DateTimeImmutable|null $authCodeExpiresOn When the auth code expires, if the marketplace told us. Null
     *     when it did not
     */
    public function __construct(
        public readonly string $authCode,
        public readonly ?\DateTimeImmutable $authCodeExpiresOn = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            authCode: $data['auth_code'],
            authCodeExpiresOn: isset($data['auth_code_expires_on']) ? new \DateTimeImmutable($data['auth_code_expires_on']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'auth_code' => $this->authCode,
            'auth_code_expires_on' => $this->authCodeExpiresOn,
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
