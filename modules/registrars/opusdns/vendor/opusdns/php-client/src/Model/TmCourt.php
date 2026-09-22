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
 * Court resolution reference (courtType in RFC 9361)
 */
final readonly class TmCourt implements ApiModel
{
    /**
     * @param string $cc ISO 3166-2 jurisdiction country code
     * @param string $courtName Name of the court
     * @param string $refNum Reference number of the court resolution
     * @param list<string>|null $region Region(s) within the jurisdiction
     */
    public function __construct(
        public string $cc,
        public string $courtName,
        public string $refNum,
        public ?array $region = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            cc: $data['cc'],
            courtName: $data['court_name'],
            refNum: $data['ref_num'],
            region: $data['region'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'cc' => $this->cc,
            'court_name' => $this->courtName,
            'ref_num' => $this->refNum,
            'region' => $this->region,
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
