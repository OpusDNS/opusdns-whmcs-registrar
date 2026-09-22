<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\LevelOfAssurance;
use OpusDNS\Client\Serializer;

final readonly class ContactVerificationEidInformation implements ApiModel
{
    public function __construct(
        public string $eidScheme,
        public LevelOfAssurance|string $levelOfAssurance,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            eidScheme: $data['eid_scheme'],
            levelOfAssurance: LevelOfAssurance::tryFrom($data['level_of_assurance']) ?? $data['level_of_assurance'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'eid_scheme' => $this->eidScheme,
            'level_of_assurance' => $this->levelOfAssurance,
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
