<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainWithdrawRequest implements ApiModel
{
    /**
     * @param bool $zoneDelete Informs the registry whether the zone for that domain has been already deleted - as
     *     took from the docs: "(...) the registrar informs the registry that he has stopped the nameservice for the
     *     specified domain"
     */
    public function __construct(
        public bool $zoneDelete,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            zoneDelete: $data['zone_delete'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'zone_delete' => $this->zoneDelete,
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
