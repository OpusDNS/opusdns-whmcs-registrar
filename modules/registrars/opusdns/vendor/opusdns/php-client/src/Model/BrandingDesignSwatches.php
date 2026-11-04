<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class BrandingDesignSwatches implements ApiModel
{
    /**
     * @param array<string, string>|null $dark
     * @param array<string, string>|null $light
     */
    public function __construct(
        public ?array $dark = null,
        public ?array $light = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            dark: isset($data['dark']) ? (array) $data['dark'] : null,
            light: isset($data['light']) ? (array) $data['light'] : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'dark' => $this->dark === null ? null : ($this->dark === [] ? new \stdClass() : $this->dark),
            'light' => $this->light === null ? null : ($this->light === [] ? new \stdClass() : $this->light),
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
