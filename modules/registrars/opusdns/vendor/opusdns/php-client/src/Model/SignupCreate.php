<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class SignupCreate implements ApiModel
{
    /**
     * @param OrganizationCreate $organization Organization signup.
     * @param UserCreate $user User signup to platform.
     * @param list<UserAgreementAcceptance>|null $agreements User agreement acceptances.
     * @param TermsOfServiceAccept|null $termsOfService Terms of service acceptance (legacy).
     */
    public function __construct(
        public OrganizationCreate $organization,
        public UserCreate $user,
        public ?array $agreements = null,
        public ?TermsOfServiceAccept $termsOfService = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            organization: OrganizationCreate::fromArray($data['organization']),
            user: UserCreate::fromArray($data['user']),
            agreements: isset($data['agreements']) ? array_map(static fn (array $item): UserAgreementAcceptance => UserAgreementAcceptance::fromArray($item), $data['agreements']) : null,
            termsOfService: isset($data['terms_of_service']) ? TermsOfServiceAccept::fromArray($data['terms_of_service']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'organization' => $this->organization,
            'user' => $this->user,
            'agreements' => $this->agreements,
            'terms_of_service' => $this->termsOfService,
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
