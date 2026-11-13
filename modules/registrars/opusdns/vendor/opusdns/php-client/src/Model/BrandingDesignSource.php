<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class BrandingDesignSource implements ApiModel
{
    /**
     * @param list<string>|null $signals
     */
    public function __construct(
        public readonly ?string $kind = null,
        public readonly ?string $logoAssetUrl = null,
        public readonly ?string $presetId = null,
        public readonly ?array $signals = null,
        public readonly ?string $url = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            kind: $data['kind'] ?? null,
            logoAssetUrl: $data['logo_asset_url'] ?? null,
            presetId: $data['preset_id'] ?? null,
            signals: $data['signals'] ?? null,
            url: $data['url'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'kind' => $this->kind,
            'logo_asset_url' => $this->logoAssetUrl,
            'preset_id' => $this->presetId,
            'signals' => $this->signals,
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
