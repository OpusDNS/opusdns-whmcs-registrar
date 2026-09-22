<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class Communication implements ApiModel
{
    /**
     * @param list<string> $timedelta The Timedeltas of when to send a verification notice of the Communication
     *     Channel [+0D, +4D, +12D, +15D, +27D]
     * @param string $type Which Communication channel is used for the Verification [email]
     */
    public function __construct(
        public array $timedelta,
        public string $type,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            timedelta: $data['timedelta'],
            type: $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'timedelta' => $this->timedelta,
            'type' => $this->type,
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
