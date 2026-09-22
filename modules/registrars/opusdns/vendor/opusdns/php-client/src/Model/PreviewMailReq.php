<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class PreviewMailReq implements ApiModel
{
    /**
     * @param string $languageCode Locale to render in (e.g. en); falls back to the template's default
     * @param string $templateName Template to render, as listed by the template catalog
     * @param BrandingDocument|null $brandingDocument Draft branding document to render the preview with; omit to
     *     preview with the default OpusDNS branding. Only the fields the template uses are applied, the rest are
     *     ignored.
     */
    public function __construct(
        public string $languageCode,
        public string $templateName,
        public ?BrandingDocument $brandingDocument = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            languageCode: $data['language_code'],
            templateName: $data['template_name'],
            brandingDocument: isset($data['branding_document']) ? BrandingDocument::fromArray($data['branding_document']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'language_code' => $this->languageCode,
            'template_name' => $this->templateName,
            'branding_document' => $this->brandingDocument,
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
