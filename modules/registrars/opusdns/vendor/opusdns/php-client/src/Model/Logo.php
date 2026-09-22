<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class Logo implements ApiModel
{
    public function __construct(
        public ?string $dark = null,
        public ?string $favicon = null,
        public ?string $icon = null,
        public ?string $light = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            dark: $data['dark'] ?? null,
            favicon: $data['favicon'] ?? null,
            icon: $data['icon'] ?? null,
            light: $data['light'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'dark' => $this->dark,
            'favicon' => $this->favicon,
            'icon' => $this->icon,
            'light' => $this->light,
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
