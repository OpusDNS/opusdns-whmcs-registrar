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

final class DnsRecordPatchOp implements ApiModel
{
    public function __construct(
        public readonly PatchOp|string $op,
        public readonly DnsRrsetWithOneRecordPatch $record,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            op: PatchOp::tryFrom($data['op']) ?? $data['op'],
            record: DnsRrsetWithOneRecordPatch::fromArray($data['record']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'op' => $this->op,
            'record' => $this->record,
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
