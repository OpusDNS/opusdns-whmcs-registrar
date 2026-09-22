<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * UDRP case reference (udrpType in RFC 9361)
 */
final readonly class TmUdrp implements ApiModel
{
    /**
     * @param string $caseNo UDRP case number
     * @param string $udrpProvider Name of the UDRP provider
     */
    public function __construct(
        public string $caseNo,
        public string $udrpProvider,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            caseNo: $data['case_no'],
            udrpProvider: $data['udrp_provider'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'case_no' => $this->caseNo,
            'udrp_provider' => $this->udrpProvider,
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
