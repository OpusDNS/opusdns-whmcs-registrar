<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class ValidationError implements ApiModel
{
    /**
     * @param list<string|int> $loc
     * @param array<string, mixed>|null $ctx
     */
    public function __construct(
        public readonly array $loc,
        public readonly string $msg,
        public readonly string $type,
        public readonly ?array $ctx = null,
        public readonly mixed $input = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            loc: $data['loc'],
            msg: $data['msg'],
            type: $data['type'],
            ctx: isset($data['ctx']) ? (array) $data['ctx'] : null,
            input: $data['input'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'loc' => $this->loc,
            'msg' => $this->msg,
            'type' => $this->type,
            'ctx' => $this->ctx === null ? null : ($this->ctx === [] ? new \stdClass() : $this->ctx),
            'input' => $this->input,
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
