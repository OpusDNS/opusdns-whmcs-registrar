<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class Theme implements ApiModel
{
    public function __construct(
        public ?Palette $dark = null,
        public ?string $fontFamily = null,
        public ?string $fontUrl = null,
        public ?Palette $light = null,
        public ?string $radius = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            dark: isset($data['dark']) ? Palette::fromArray($data['dark']) : null,
            fontFamily: $data['font_family'] ?? null,
            fontUrl: $data['font_url'] ?? null,
            light: isset($data['light']) ? Palette::fromArray($data['light']) : null,
            radius: $data['radius'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'dark' => $this->dark,
            'font_family' => $this->fontFamily,
            'font_url' => $this->fontUrl,
            'light' => $this->light,
            'radius' => $this->radius,
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
