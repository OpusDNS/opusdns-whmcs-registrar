<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class BrandingDesignActions implements ApiModel
{
    public function __construct(
        public ?bool $canActivate = null,
        public ?string $downloadFilename = null,
        public ?BrandingDesignWrite $write = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            canActivate: $data['can_activate'] ?? null,
            downloadFilename: $data['download_filename'] ?? null,
            write: isset($data['write']) ? BrandingDesignWrite::fromArray($data['write']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'can_activate' => $this->canActivate,
            'download_filename' => $this->downloadFilename,
            'write' => $this->write,
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
