<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class InternetXCredentials implements ApiModel
{
    /**
     * @param string $password Password at the registrar
     * @param string $username User name at the registrar
     * @param int $context Your AutoDNS context; keep 4 unless your account uses another
     * @param bool $includeSubAccounts Also sync the domains, zones and contacts of the account's sub-accounts
     */
    public function __construct(
        public readonly string $password,
        public readonly string $username,
        public readonly int $context = 4,
        public readonly bool $includeSubAccounts = false,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            password: $data['password'],
            username: $data['username'],
            context: $data['context'] ?? 4,
            includeSubAccounts: $data['include_sub_accounts'] ?? false,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'password' => $this->password,
            'username' => $this->username,
            'context' => $this->context,
            'include_sub_accounts' => $this->includeSubAccounts,
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
