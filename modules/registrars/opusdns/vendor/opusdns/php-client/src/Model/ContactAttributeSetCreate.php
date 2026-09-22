<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactAttributeSetCreate implements ApiModel
{
    /**
     * @param array<string, string> $attributes Key-value map of contact attributes for this set
     * @param string $label A human-readable label explaining the purpose of this attribute set
     * @param string $tld The TLD this attribute set applies to (e.g. 'de', '.de', 'DE')
     */
    public function __construct(
        public array $attributes,
        public string $label,
        public string $tld,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            attributes: (array) $data['attributes'],
            label: $data['label'],
            tld: $data['tld'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'attributes' => ($this->attributes === [] ? new \stdClass() : $this->attributes),
            'label' => $this->label,
            'tld' => $this->tld,
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
