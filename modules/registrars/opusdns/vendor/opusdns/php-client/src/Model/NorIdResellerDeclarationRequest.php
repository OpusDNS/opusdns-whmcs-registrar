<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class NorIdResellerDeclarationRequest implements ApiModel
{
    /**
     * @param string $acceptName The full name of the person signing the applicant declaration. For private
     *     individuals this is the subscriber personally; for organizations it must be an authorized representative.
     * @param \DateTimeImmutable|null $acceptDate UTC timestamp of the declaration signature. Only provide it when
     *     the declaration was signed out-of-band (e.g. via Norid's own tool); defaults to the submission time.
     */
    public function __construct(
        public string $acceptName,
        public ?\DateTimeImmutable $acceptDate = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            acceptName: $data['accept_name'],
            acceptDate: isset($data['accept_date']) ? new \DateTimeImmutable($data['accept_date']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'accept_name' => $this->acceptName,
            'accept_date' => $this->acceptDate,
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
