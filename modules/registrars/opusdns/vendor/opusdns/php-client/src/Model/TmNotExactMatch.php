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
 * Signals claim was added by non-exact match rules (noExactMatchType in RFC 9361)
 */
final readonly class TmNotExactMatch implements ApiModel
{
    /**
     * @param list<TmCourt>|null $court
     * @param string $intro Introductory text for the non-exact match section
     * @param list<TmUdrp>|null $udrp
     */
    public function __construct(
        public ?array $court = null,
        public string $intro = 'This domain name label has previously been found to be used or registered abusively against the following trademarks according to the referenced decisions:',
        public ?array $udrp = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            court: isset($data['court']) ? array_map(static fn (array $item): TmCourt => TmCourt::fromArray($item), $data['court']) : null,
            intro: $data['intro'] ?? 'This domain name label has previously been found to be used or registered abusively against the following trademarks according to the referenced decisions:',
            udrp: isset($data['udrp']) ? array_map(static fn (array $item): TmUdrp => TmUdrp::fromArray($item), $data['udrp']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'court' => $this->court,
            'intro' => $this->intro,
            'udrp' => $this->udrp,
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
