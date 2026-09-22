<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class RgpOperations implements ApiModel
{
    /**
     * @param bool $report Whether registry supports RGP restore report
     * @param bool $request Whether registry supports RGP restore request
     */
    public function __construct(
        public bool $report = true,
        public bool $request = true,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            report: $data['report'] ?? true,
            request: $data['request'] ?? true,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'report' => $this->report,
            'request' => $this->request,
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
