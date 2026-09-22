<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class IdnBase implements ApiModel
{
    /**
     * @param bool $idnCapable IDN allowed
     * @param list<string>|null $idnTables Allowed IDN characters, file with the IDN codes
     */
    public function __construct(
        public bool $idnCapable,
        public ?array $idnTables = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            idnCapable: $data['idn_capable'],
            idnTables: $data['idn_tables'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'idn_capable' => $this->idnCapable,
            'idn_tables' => $this->idnTables,
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
