<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class PublicAuthRequestForm implements ApiModel
{
    /**
     * @param string $clientId The organization ID associated with the credentials. TypeID prefix: organization.
     * @param string $clientSecret Your client secret.
     * @param string $grantType The grant type for the authentication request (should always be
     *     'client_credentials').
     */
    public function __construct(
        public string $clientId,
        public string $clientSecret,
        public string $grantType,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            clientId: $data['client_id'],
            clientSecret: $data['client_secret'],
            grantType: $data['grant_type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => $this->grantType,
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
