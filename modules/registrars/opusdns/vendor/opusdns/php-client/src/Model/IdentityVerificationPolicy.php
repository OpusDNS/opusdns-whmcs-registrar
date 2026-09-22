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

/**
 * A registry that requires the contact to have been identity-verified before it accepts it.
 *
 * The vocabulary is the contact-verification service's, because that service is what the claims are
 * checked against. What a registry accepts as evidence is a policy of its own and does not follow from
 * the claim: `.dk` wants a photo ID for `NAME`, while a registry happy with a written attestation
 * would leave `accepted_proofs` out.
 */
final readonly class IdentityVerificationPolicy implements ApiModel
{
    /**
     * @param list<DomainContactType|string> $contactRoles For which type of Contacts this verification needs to be
     *     done
     * @param bool $enabled Whether this Verification is enabled
     * @param list<RequiredClaim> $requiredClaims The claims that must be verified before a contact can be used on
     *     this TLD
     * @param string $suspensionDelay After how many Days should the domain be suspended
     * @param bool $suspensionOnFailure Should the Domain be suspended if the verification was not successfull
     * @param list<string> $trigger The operations that will trigger this verification
     */
    public function __construct(
        public array $contactRoles,
        public bool $enabled,
        public array $requiredClaims,
        public string $suspensionDelay,
        public bool $suspensionOnFailure,
        public array $trigger,
        public ?Period $validityPeriod = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            contactRoles: array_map(static fn (string $item): DomainContactType|string => DomainContactType::tryFrom($item) ?? $item, $data['contact_roles']),
            enabled: $data['enabled'],
            requiredClaims: array_map(static fn (array $item): RequiredClaim => RequiredClaim::fromArray($item), $data['required_claims']),
            suspensionDelay: $data['suspension_delay'],
            suspensionOnFailure: $data['suspension_on_failure'],
            trigger: $data['trigger'],
            validityPeriod: isset($data['validity_period']) ? Period::fromArray($data['validity_period']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'contact_roles' => $this->contactRoles,
            'enabled' => $this->enabled,
            'required_claims' => $this->requiredClaims,
            'suspension_delay' => $this->suspensionDelay,
            'suspension_on_failure' => $this->suspensionOnFailure,
            'trigger' => $this->trigger,
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
