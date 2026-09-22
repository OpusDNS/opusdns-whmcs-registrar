<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ContactCreateBulkTemplate implements ApiModel
{
    /**
     * @param string $country The country of the contacts (ISO 3166-1 alpha-2, plus XK for Kosovo)
     * @param bool $disclose Whether contact details should be disclosed in WHOIS
     * @param string|null $org Organization name
     * @param string|null $state State/province
     * @param string|null $title Contact title
     */
    public function __construct(
        public string $country,
        public bool $disclose,
        public ?string $org = null,
        public ?string $state = null,
        public ?string $title = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            country: $data['country'],
            disclose: $data['disclose'],
            org: $data['org'] ?? null,
            state: $data['state'] ?? null,
            title: $data['title'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'country' => $this->country,
            'disclose' => $this->disclose,
            'org' => $this->org,
            'state' => $this->state,
            'title' => $this->title,
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
