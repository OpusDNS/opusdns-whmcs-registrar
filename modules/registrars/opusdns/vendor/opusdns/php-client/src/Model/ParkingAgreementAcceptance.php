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
 * Parking agreement acceptance details.
 */
final readonly class ParkingAgreementAcceptance implements ApiModel
{
    /**
     * @param bool $accepted Whether the agreement has been accepted
     * @param string $url URL where the parking agreement can be found
     * @param string $version Version of the parking agreement being accepted
     */
    public function __construct(
        public bool $accepted,
        public string $url,
        public string $version,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            accepted: $data['accepted'],
            url: $data['url'],
            version: $data['version'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'accepted' => $this->accepted,
            'url' => $this->url,
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
