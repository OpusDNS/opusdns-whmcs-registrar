<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\RenewalModeDTO;
use OpusDNS\Client\Serializer;

final readonly class SetRenewalModeReq implements ApiModel
{
    /**
     * @param RenewalModeDTO|string $renewalMode expire cancels the set at period end (serves out the term), renew
     *     un-cancels (resumes auto-renew)
     */
    public function __construct(
        public RenewalModeDTO|string $renewalMode,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            renewalMode: RenewalModeDTO::tryFrom($data['renewal_mode']) ?? $data['renewal_mode'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'renewal_mode' => $this->renewalMode,
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
