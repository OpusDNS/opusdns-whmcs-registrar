<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\HolderEntitlement;
use OpusDNS\Client\Serializer;

/**
 * Holder of the mark (holderType in RFC 9361). name or org must be set.
 */
final readonly class TmHolder implements ApiModel
{
    public function __construct(
        public TmAddr $addr,
        public HolderEntitlement|string $entitlement,
        public ?string $email = null,
        public ?string $fax = null,
        public ?string $name = null,
        public ?string $org = null,
        public ?string $voice = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            addr: TmAddr::fromArray($data['addr']),
            entitlement: HolderEntitlement::tryFrom($data['entitlement']) ?? $data['entitlement'],
            email: $data['email'] ?? null,
            fax: $data['fax'] ?? null,
            name: $data['name'] ?? null,
            org: $data['org'] ?? null,
            voice: $data['voice'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'addr' => $this->addr,
            'entitlement' => $this->entitlement,
            'email' => $this->email,
            'fax' => $this->fax,
            'name' => $this->name,
            'org' => $this->org,
            'voice' => $this->voice,
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
