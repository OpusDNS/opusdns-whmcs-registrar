<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\DomainContactType;
use OpusDNS\Client\Serializer;

final readonly class EmailVerificationPolicy implements ApiModel
{
    /**
     * @param list<DomainContactType|string> $contactRoles For which type of Contacts this verification needs to be
     *     done
     * @param bool $enabled Whether this Verification is enabled
     * @param string $suspensionDelay After how many Days should the domain be suspended
     * @param bool $suspensionOnFailure Should the Domain be suspended if the verification was not successfull
     * @param list<string> $trigger The operations that will trigger this verification
     */
    public function __construct(
        public Communication $communication,
        public array $contactRoles,
        public bool $enabled,
        public string $suspensionDelay,
        public bool $suspensionOnFailure,
        public array $trigger,
        public string $verificationMethod,
        public ?Period $validityPeriod = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            communication: Communication::fromArray($data['communication']),
            contactRoles: array_map(static fn (string $item): DomainContactType|string => DomainContactType::tryFrom($item) ?? $item, $data['contact_roles']),
            enabled: $data['enabled'],
            suspensionDelay: $data['suspension_delay'],
            suspensionOnFailure: $data['suspension_on_failure'],
            trigger: $data['trigger'],
            verificationMethod: $data['verification_method'],
            validityPeriod: isset($data['validity_period']) ? Period::fromArray($data['validity_period']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'communication' => $this->communication,
            'contact_roles' => $this->contactRoles,
            'enabled' => $this->enabled,
            'suspension_delay' => $this->suspensionDelay,
            'suspension_on_failure' => $this->suspensionOnFailure,
            'trigger' => $this->trigger,
            'verification_method' => $this->verificationMethod,
            'validity_period' => $this->validityPeriod,
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
