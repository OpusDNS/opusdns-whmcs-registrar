<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class Support implements ApiModel
{
    public function __construct(
        public ?string $email = null,
        public ?string $helpCenterUrl = null,
        public ?string $statusUrl = null,
        public ?string $url = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            email: $data['email'] ?? null,
            helpCenterUrl: $data['help_center_url'] ?? null,
            statusUrl: $data['status_url'] ?? null,
            url: $data['url'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'email' => $this->email,
            'help_center_url' => $this->helpCenterUrl,
            'status_url' => $this->statusUrl,
            'url' => $this->url,
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
