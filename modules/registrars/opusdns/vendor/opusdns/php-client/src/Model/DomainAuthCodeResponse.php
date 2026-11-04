<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\AuthCodeDelivery;
use OpusDNS\Client\Serializer;

final readonly class DomainAuthCodeResponse implements ApiModel
{
    /**
     * @param AuthCodeDelivery|string $delivery Where the auth code ends up: `response` returns it in `auth_code`,
     *     `registrant_email` means the registry emails it to the registrant and it never reaches us
     * @param string $name The domain name the auth code belongs to
     * @param string|null $authCode The auth code, when `delivery` is `response`. Hidden when the caller cannot view
     *     the domain's auth codes
     * @param \DateTimeImmutable|null $authCodeExpiresOn When the auth code expires, if the registry limits its
     *     validity
     * @param list<string>|null $recipients The addresses the registry sent the auth code to, when it reports them
     */
    public function __construct(
        public AuthCodeDelivery|string $delivery,
        public string $name,
        public ?string $authCode = null,
        public ?\DateTimeImmutable $authCodeExpiresOn = null,
        public ?array $recipients = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            delivery: AuthCodeDelivery::tryFrom($data['delivery']) ?? $data['delivery'],
            name: $data['name'],
            authCode: $data['auth_code'] ?? null,
            authCodeExpiresOn: isset($data['auth_code_expires_on']) ? new \DateTimeImmutable($data['auth_code_expires_on']) : null,
            recipients: $data['recipients'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'delivery' => $this->delivery,
            'name' => $this->name,
            'auth_code' => $this->authCode,
            'auth_code_expires_on' => $this->authCodeExpiresOn,
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
