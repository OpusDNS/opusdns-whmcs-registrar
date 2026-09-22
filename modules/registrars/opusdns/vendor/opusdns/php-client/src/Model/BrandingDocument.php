<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class BrandingDocument implements ApiModel
{
    public function __construct(
        public ?Auth $auth = null,
        public ?Brand $brand = null,
        public ?Content $content = null,
        public ?Theme $theme = null,
        public int $version = 1,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            auth: isset($data['auth']) ? Auth::fromArray($data['auth']) : null,
            brand: isset($data['brand']) ? Brand::fromArray($data['brand']) : null,
            content: isset($data['content']) ? Content::fromArray($data['content']) : null,
            theme: isset($data['theme']) ? Theme::fromArray($data['theme']) : null,
            version: $data['version'] ?? 1,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'auth' => $this->auth,
            'brand' => $this->brand,
            'content' => $this->content,
            'theme' => $this->theme,
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
