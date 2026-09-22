<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\RenewalMode;
use OpusDNS\Client\Serializer;

final readonly class DomainTransferPayloadData implements ApiModel
{
    /**
     * @param string $name The domain to be created
     * @param RenewalMode|string $renewalMode The renewal mode of the domain
     * @param array<string, string>|null $attributes Additional attributes of the domain, keyed by attribute name.
     *     Values are strings. Customer-settable keys: - `auto_renew_period`: `monthly` or `yearly`. All TLDs on
     *     create, transfer-in and update. Selects the period of the next renewal; the current expiry date does not
     *     move. On transfer-in without `period` it also sets the period added by the transfer. Omitted on create or
     *     transfer-in, it follows the term being bought: a one-month `period` renews monthly and anything else
     *     yearly, except a longer month-unit term, which leaves it unset: the next renewal then charges the term
     *     that was bought where the TLD still renews for that term, and the product's default billing period
     *     otherwise. Supplying `monthly` where the TLD sells no one-month renewal is rejected on create, transfer-in
     *     and update; a `monthly` stored before that rule applied is ignored at renewal. -
     *     `music_registrant_attestation`: `true`. `.music` registration. - `nic_it_compliance_confirmation`: `true`.
     *     `.it` registration and transfer. - `travel_industry_acknowledgement`: `true`. `.travel` registration. -
     *     `internet_ee_registrant_agreement`: `true`. `.ee` registration. - `punktum_dk_terms_acceptance`: `true`.
     *     `.dk` registration and registrant change. - `de_general_request_contact`, `de_abuse_contact`: id of a
     *     contact whose `.de` attribute set has `DE_CONTACT_TYPE` = `REQUEST`. `.de` only. Boolean keys also accept
     *     `1` and `yes`. Written by the platform and rejected if supplied: `verification_required`, `promotion`,
     *     `promotion_eligibility`, `nor_id_declaration`, `nor_id_declaration_token`, `punktum_dk_tracking_no`,
     *     `domain_contact_attributes`, `registry_reseller_id`. They are never returned under `attributes`; inline
     *     contact attributes surface on the matching `contacts` entry instead. Derived from the signed `.no`
     *     applicant declaration and ignored if supplied on create: `nor_id_applicant_version`,
     *     `nor_id_applicant_accept_name`, `nor_id_applicant_accept_date`. On update, every registry stores the
     *     supplied attributes, and the update is not sent to the registry unless they store; a registry that rejects
     *     the change stores nothing. An empty value removes the stored attribute, except for `auto_renew_period`,
     *     whose only accepted values are `monthly` and `yearly`. `.dk` also reads `punktum_dk_terms_acceptance` to
     *     confirm a registrant change. An update cannot change what the registrant accepted at registration, so
     *     these are rejected on update: `music_registrant_attestation`, `nic_it_compliance_confirmation`,
     *     `travel_industry_acknowledgement`, `internet_ee_registrant_agreement` and the three `nor_id_applicant_*`
     *     keys. `punktum_dk_terms_acceptance` stays settable for a registrant change but cannot be removed with an
     *     empty value.
     * @param string|null $authCode The auth code for the domain
     * @param array<string, list<ContactHandle>>|null $contacts The contacts of the domain. Optional for transfers
     *     when all supported contact roles have a minimum of 0 in the TLD specification.
     * @param bool $createZone Create a zone for the domain on OpusDNS nameserver infrastructure
     * @param string|null $expectedPrice Expected price for premium domain confirmation
     * @param list<Nameserver>|null $nameservers The name servers for the domain
     * @param DomainPeriod|null $period Additional registration period to add to the domain upon transfer completion.
     *     If omitted, the registry default policy will be applied.
     */
    public function __construct(
        public string $name,
        public RenewalMode|string $renewalMode,
        public ?array $attributes = null,
        public ?string $authCode = null,
        public ?array $contacts = null,
        public bool $createZone = false,
        public ?string $expectedPrice = null,
        public ?array $nameservers = null,
        public ?DomainPeriod $period = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            renewalMode: RenewalMode::tryFrom($data['renewal_mode']) ?? $data['renewal_mode'],
            attributes: isset($data['attributes']) ? (array) $data['attributes'] : null,
            authCode: $data['auth_code'] ?? null,
            contacts: isset($data['contacts']) ? array_map(static fn (array $value): array => array_map(static fn (array $item): ContactHandle => ContactHandle::fromArray($item), $value), (array) $data['contacts']) : null,
            createZone: $data['create_zone'] ?? false,
            expectedPrice: $data['expected_price'] ?? null,
            nameservers: isset($data['nameservers']) ? array_map(static fn (array $item): Nameserver => Nameserver::fromArray($item), $data['nameservers']) : null,
            period: isset($data['period']) ? DomainPeriod::fromArray($data['period']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'renewal_mode' => $this->renewalMode,
            'attributes' => $this->attributes === null ? null : ($this->attributes === [] ? new \stdClass() : $this->attributes),
            'auth_code' => $this->authCode,
            'contacts' => $this->contacts === null ? null : ($this->contacts === [] ? new \stdClass() : $this->contacts),
            'create_zone' => $this->createZone,
            'expected_price' => $this->expectedPrice,
            'nameservers' => $this->nameservers,
            'period' => $this->period,
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
