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
 * The waitlisted products you may see.
 */
final readonly class WaitlistProductListResponse implements ApiModel
{
    /**
     * @param list<WaitlistProductState>|null $products Waitlisted products you may see
     */
    public function __construct(
        public ?array $products = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            products: isset($data['products']) ? array_map(static fn (array $item): WaitlistProductState => WaitlistProductState::fromArray($item), $data['products']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'products' => $this->products,
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
