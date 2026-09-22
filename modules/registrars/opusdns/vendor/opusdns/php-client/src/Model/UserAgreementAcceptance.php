<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\AgreementType;
use OpusDNS\Client\Serializer;

final readonly class UserAgreementAcceptance implements ApiModel
{
    /**
     * @param bool $accepted Whether the agreement has been accepted.
     * @param AgreementType|string $type Type of agreement being accepted.
     * @param string|null $url URL where the agreement can be found.
     * @param string|null $version Version of the agreement being accepted.
     */
    public function __construct(
        public bool $accepted,
        public AgreementType|string $type,
        public ?string $url = null,
        public ?string $version = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            accepted: $data['accepted'],
            type: AgreementType::tryFrom($data['type']) ?? $data['type'],
            url: $data['url'] ?? null,
            version: $data['version'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'accepted' => $this->accepted,
            'type' => $this->type,
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
