<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class BrandingDesignPreview implements ApiModel
{
    public function __construct(
        public ?string $darkStrategy = null,
        public ?string $fontFamily = null,
        public ?string $mood = null,
        public ?string $neutralTint = null,
        public ?string $presetBase = null,
        public ?string $primaryColor = null,
        public ?float $radiusRem = null,
        public ?bool $recolorPreset = null,
        public ?BrandingDesignSwatches $swatches = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            darkStrategy: $data['dark_strategy'] ?? null,
            fontFamily: $data['font_family'] ?? null,
            mood: $data['mood'] ?? null,
            neutralTint: $data['neutral_tint'] ?? null,
            presetBase: $data['preset_base'] ?? null,
            primaryColor: $data['primary_color'] ?? null,
            radiusRem: $data['radius_rem'] ?? null,
            recolorPreset: $data['recolor_preset'] ?? null,
            swatches: isset($data['swatches']) ? BrandingDesignSwatches::fromArray($data['swatches']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'dark_strategy' => $this->darkStrategy,
            'font_family' => $this->fontFamily,
            'mood' => $this->mood,
            'neutral_tint' => $this->neutralTint,
            'preset_base' => $this->presetBase,
            'primary_color' => $this->primaryColor,
            'radius_rem' => $this->radiusRem,
            'recolor_preset' => $this->recolorPreset,
            'swatches' => $this->swatches,
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
