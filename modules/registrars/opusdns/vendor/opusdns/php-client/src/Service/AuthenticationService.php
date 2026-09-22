<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Model\OrganizationCredential;
use OpusDNS\Client\Model\OrganizationTokenResponse;
use OpusDNS\Client\Model\PublicAuthRequestForm;
use OpusDNS\Client\Model\SignupCreate;
use OpusDNS\Client\Model\SignupResponse;
use OpusDNS\Client\Model\UserTokenResponse;
use OpusDNS\Client\Union;

/**
 * Operations tagged "authentication".
 */
final class AuthenticationService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Introspect the current API key
     *
     * Returns the stored record for the API key (or organization token) used to authenticate the request,
     * including its organization. Requires API-key or organization-token authentication; user tokens are
     * rejected.
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function introspectClientCredential(?string $xDatetimeFormat = null): OrganizationCredential
    {
        $response = $this->client->request(
            'GET',
            Endpoint::AUTH_CLIENT_CREDENTIALS_INTROSPECT,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): OrganizationCredential => OrganizationCredential::fromArray($data));
    }

    /**
     * Signup
     *
     * @param SignupCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function signup(SignupCreate|array $body, ?string $xDatetimeFormat = null): SignupResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::AUTH_SIGNUP,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): SignupResponse => SignupResponse::fromArray($data));
    }

    /**
     * Issue Organization Token
     *
     * @param PublicAuthRequestForm|array<string, mixed>|null $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     * @return OrganizationTokenResponse|UserTokenResponse
     */
    public function issueOrganizationToken(
        PublicAuthRequestForm|array|null $body = null,
        ?string $xDatetimeFormat = null,
    ): OrganizationTokenResponse|UserTokenResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::AUTH_TOKEN,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): OrganizationTokenResponse|UserTokenResponse => Union::hydrate($data, [UserTokenResponse::class => ['access_token', 'expires_in', 'refresh_token', 'refresh_expires_in'], OrganizationTokenResponse::class => ['access_token', 'expires_in']]));
    }
}
