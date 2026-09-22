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
 * Response after parking signup.
 */
final readonly class ParkingSignupResponse implements ApiModel
{
    /**
     * @param bool $agreementStored Whether the agreement acceptance was stored
     * @param bool $success Whether the signup was successful
     */
    public function __construct(
        public bool $agreementStored,
        public bool $success,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            agreementStored: $data['agreement_stored'],
            success: $data['success'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'agreement_stored' => $this->agreementStored,
            'success' => $this->success,
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
