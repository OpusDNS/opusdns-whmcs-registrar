<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\ContactType;
use OpusDNS\Client\Serializer;

/**
 * Contact / representative of the mark (contactType in RFC 9361)
 */
final readonly class TmContact implements ApiModel
{
    public function __construct(
        public TmAddr $addr,
        public string $email,
        public string $name,
        public ContactType|string $type,
        public string $voice,
        public ?string $fax = null,
        public ?string $org = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            addr: TmAddr::fromArray($data['addr']),
            email: $data['email'],
            name: $data['name'],
            type: ContactType::tryFrom($data['type']) ?? $data['type'],
            voice: $data['voice'],
            fax: $data['fax'] ?? null,
            org: $data['org'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'addr' => $this->addr,
            'email' => $this->email,
            'name' => $this->name,
            'type' => $this->type,
            'voice' => $this->voice,
            'fax' => $this->fax,
            'org' => $this->org,
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
