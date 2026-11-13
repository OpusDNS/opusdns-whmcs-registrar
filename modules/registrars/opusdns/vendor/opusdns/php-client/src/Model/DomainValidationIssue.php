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
 * One fixable problem with a domain name, as reported by tld-spec-service.
 */
final class DomainValidationIssue implements ApiModel
{
    /**
     * @param string $code Machine-readable problem code, e.g. ERROR_DOMAIN_CHARACTER_NOT_ALLOWED
     * @param string $detail Human-readable explanation of this problem
     * @param string|null $character The offending character
     * @param string|null $codepoint Unicode codepoint of the character, e.g. U+0062
     * @param string|null $label The label the problem is in
     * @param int|null $limit The length limit that was exceeded
     * @param int|null $position 0-based codepoint index of the problem within the label, after UTS 46 mapping (e.g.
     *     full-width letters folded to ASCII)
     */
    public function __construct(
        public readonly string $code,
        public readonly string $detail,
        public readonly ?string $character = null,
        public readonly ?string $codepoint = null,
        public readonly ?string $label = null,
        public readonly ?int $limit = null,
        public readonly ?int $position = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            code: $data['code'],
            detail: $data['detail'],
            character: $data['character'] ?? null,
            codepoint: $data['codepoint'] ?? null,
            label: $data['label'] ?? null,
            limit: $data['limit'] ?? null,
            position: $data['position'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'code' => $this->code,
            'detail' => $this->detail,
            'character' => $this->character,
            'codepoint' => $this->codepoint,
            'label' => $this->label,
            'limit' => $this->limit,
            'position' => $this->position,
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
