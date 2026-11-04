<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class BrandingDesignVariant implements ApiModel
{
    /**
     * @param array<string, mixed> $document
     */
    public function __construct(
        public array $document,
        public string $variantId,
        public ?BrandingDesignPreview $preview = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            document: (array) $data['document'],
            variantId: $data['variant_id'],
            preview: isset($data['preview']) ? BrandingDesignPreview::fromArray($data['preview']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'document' => ($this->document === [] ? new \stdClass() : $this->document),
            'variant_id' => $this->variantId,
            'preview' => $this->preview,
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
