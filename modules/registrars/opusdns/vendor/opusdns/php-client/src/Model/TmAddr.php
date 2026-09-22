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
 * Address information (addrType in RFC 9361)
 */
final readonly class TmAddr implements ApiModel
{
    /**
     * @param string $cc ISO 3166-2 two-character country code
     * @param list<string> $street
     */
    public function __construct(
        public string $cc,
        public string $city,
        public array $street,
        public ?string $pc = null,
        public ?string $sp = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            cc: $data['cc'],
            city: $data['city'],
            street: $data['street'],
            pc: $data['pc'] ?? null,
            sp: $data['sp'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'cc' => $this->cc,
            'city' => $this->city,
            'street' => $this->street,
            'pc' => $this->pc,
            'sp' => $this->sp,
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
