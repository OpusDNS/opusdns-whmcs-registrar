<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class BrandingAsset implements ApiModel
{
    /**
     * @param string $assetId Opaque handle used to delete or reference the asset
     * @param string $assetUrl Public URL of the asset
     * @param int $sizeBytes Asset size in bytes
     * @param \DateTimeImmutable $updatedOn Last-modified timestamp
     * @param string|null $contentType MIME type of the asset
     */
    public function __construct(
        public string $assetId,
        public string $assetUrl,
        public int $sizeBytes,
        public \DateTimeImmutable $updatedOn,
        public ?string $contentType = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            assetId: $data['asset_id'],
            assetUrl: $data['asset_url'],
            sizeBytes: $data['size_bytes'],
            updatedOn: new \DateTimeImmutable($data['updated_on']),
            contentType: $data['content_type'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'asset_id' => $this->assetId,
            'asset_url' => $this->assetUrl,
            'size_bytes' => $this->sizeBytes,
            'updated_on' => $this->updatedOn,
            'content_type' => $this->contentType,
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
