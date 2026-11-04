<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class AuditFilters implements ApiModel
{
    /**
     * @param list<string> $nameList The names themselves, only when 20 or fewer.
     * @param list<string> $registrar
     * @param list<string> $tld
     * @param int $names How many zone or domain names the audit was narrowed to; 0 = none.
     */
    public function __construct(
        public array $nameList,
        public array $registrar,
        public array $tld,
        public int $names = 0,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            nameList: $data['name_list'],
            registrar: $data['registrar'],
            tld: $data['tld'],
            names: $data['names'] ?? 0,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name_list' => $this->nameList,
            'registrar' => $this->registrar,
            'tld' => $this->tld,
            'names' => $this->names,
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
