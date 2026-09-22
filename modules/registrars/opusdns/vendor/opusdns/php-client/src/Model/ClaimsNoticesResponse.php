<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ClaimsNoticesResponse implements ApiModel
{
    /**
     * @param list<ClaimsNotice> $claimsNotices
     */
    public function __construct(
        public array $claimsNotices,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            claimsNotices: array_map(static fn (array $item): ClaimsNotice => ClaimsNotice::fromArray($item), $data['claims_notices']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'claims_notices' => $this->claimsNotices,
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
