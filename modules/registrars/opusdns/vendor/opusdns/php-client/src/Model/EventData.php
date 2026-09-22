<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\EventVersion;
use OpusDNS\Client\Serializer;
use OpusDNS\Client\Union;

final readonly class EventData implements ApiModel
{
    /**
     * @param DomainRenewalDetails|DomainVerificationDetails|null $details
     */
    public function __construct(
        public string $message,
        public DomainRenewalDetails|DomainVerificationDetails|null $details = null,
        public ?EventError $error = null,
        public EventVersion|string $version = EventVersion::_1_0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            message: $data['message'],
            details: isset($data['details']) ? Union::discriminate($data['details'], 'detail_type', ['domain_renewal' => DomainRenewalDetails::class, 'domain_verification' => DomainVerificationDetails::class]) : null,
            error: isset($data['error']) ? EventError::fromArray($data['error']) : null,
            version: isset($data['version']) ? EventVersion::tryFrom($data['version']) ?? $data['version'] : EventVersion::_1_0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'message' => $this->message,
            'details' => $this->details,
            'error' => $this->error,
            'version' => $this->version,
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
