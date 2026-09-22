<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\PatchOp;
use OpusDNS\Client\Serializer;

final readonly class DnsRrsetPatchOp implements ApiModel
{
    public function __construct(
        public PatchOp|string $op,
        public DnsRrsetPatch $rrset,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            op: PatchOp::tryFrom($data['op']) ?? $data['op'],
            rrset: DnsRrsetPatch::fromArray($data['rrset']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'op' => $this->op,
            'rrset' => $this->rrset,
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
