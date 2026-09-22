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
 * Request to sign up for parking (accept parking agreement).
 */
final readonly class ParkingSignupRequest implements ApiModel
{
    /**
     * @param ParkingAgreementAcceptance $agreement Parking agreement acceptance
     */
    public function __construct(
        public ParkingAgreementAcceptance $agreement,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            agreement: ParkingAgreementAcceptance::fromArray($data['agreement']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'agreement' => $this->agreement,
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
