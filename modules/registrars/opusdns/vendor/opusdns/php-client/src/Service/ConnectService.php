<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Enum\Registrar;
use OpusDNS\Client\Model\CentralNicCredentialCreate;
use OpusDNS\Client\Model\CentralNicCredentialUpdate;
use OpusDNS\Client\Model\DomainBestellsystemCredentialCreate;
use OpusDNS\Client\Model\DomainBestellsystemCredentialUpdate;
use OpusDNS\Client\Model\EnomCredentialCreate;
use OpusDNS\Client\Model\EnomCredentialUpdate;
use OpusDNS\Client\Model\InternetXCredentialCreate;
use OpusDNS\Client\Model\InternetXCredentialUpdate;
use OpusDNS\Client\Model\MonikerCredentialCreate;
use OpusDNS\Client\Model\MonikerCredentialUpdate;
use OpusDNS\Client\Model\NicDirectCredentialCreate;
use OpusDNS\Client\Model\NicDirectCredentialUpdate;
use OpusDNS\Client\Model\NicManagerCredentialCreate;
use OpusDNS\Client\Model\NicManagerCredentialUpdate;
use OpusDNS\Client\Model\OpenSrsCredentialCreate;
use OpusDNS\Client\Model\OpenSrsCredentialUpdate;
use OpusDNS\Client\Model\OpenproviderCredentialCreate;
use OpusDNS\Client\Model\OpenproviderCredentialUpdate;
use OpusDNS\Client\Model\OpusDnsCredentialCreate;
use OpusDNS\Client\Model\OpusDnsCredentialUpdate;
use OpusDNS\Client\Model\PaginationRegistrarCredential;
use OpusDNS\Client\Model\PaginationSyncFailure;
use OpusDNS\Client\Model\RealtimeRegisterCredentialCreate;
use OpusDNS\Client\Model\RealtimeRegisterCredentialUpdate;
use OpusDNS\Client\Model\RegistrarCredential;
use OpusDNS\Client\Model\SyncStatus;
use OpusDNS\Client\Union;

/**
 * Operations tagged "connect".
 */
final class ConnectService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * List registrar accounts
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:read
     *
     * @param Registrar|string|null $registrar Filter by registrar
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listCredentials(
        Registrar|string|null $registrar = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): PaginationRegistrarCredential {
        $response = $this->client->request(
            'GET',
            Endpoint::CONNECT_REGISTRARS,
            query: ['registrar' => $registrar, 'page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationRegistrarCredential => PaginationRegistrarCredential::fromArray($data));
    }

    /**
     * Connect a registrar account
     *
     * Stores the account's login details and starts its first sync. Follow the sync with **Get sync
     * status**.
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:manage
     *
     * @param InternetXCredentialCreate|DomainBestellsystemCredentialCreate|MonikerCredentialCreate|CentralNicCredentialCreate|NicManagerCredentialCreate|OpusDnsCredentialCreate|EnomCredentialCreate|OpenSrsCredentialCreate|NicDirectCredentialCreate|OpenproviderCredentialCreate|RealtimeRegisterCredentialCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function createCredential(
        InternetXCredentialCreate|DomainBestellsystemCredentialCreate|MonikerCredentialCreate|CentralNicCredentialCreate|NicManagerCredentialCreate|OpusDnsCredentialCreate|EnomCredentialCreate|OpenSrsCredentialCreate|NicDirectCredentialCreate|OpenproviderCredentialCreate|RealtimeRegisterCredentialCreate|array $body,
        ?string $xDatetimeFormat = null,
    ): RegistrarCredential {
        $response = $this->client->request(
            'POST',
            Endpoint::CONNECT_REGISTRARS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): RegistrarCredential => RegistrarCredential::fromArray($data));
    }

    /**
     * Get a registrar account
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:read
     *
     * @param string $registrarCredentialId ID of the connected registrar account
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getCredential(string $registrarCredentialId, ?string $xDatetimeFormat = null): RegistrarCredential
    {
        $response = $this->client->request(
            'GET',
            Endpoint::CONNECT_REGISTRARS_BY_REGISTRAR_CREDENTIAL_ID,
            path: ['registrar_credential_id' => $registrarCredentialId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): RegistrarCredential => RegistrarCredential::fromArray($data));
    }

    /**
     * Update login details
     *
     * Replaces all login details and starts a sync. Send every field again. The name and the registrar
     * can't change; a different `registrar` is rejected with `422 ERROR_CREDENTIAL_REGISTRAR_MISMATCH`.
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:manage
     *
     * @param string $registrarCredentialId ID of the connected registrar account
     * @param InternetXCredentialUpdate|DomainBestellsystemCredentialUpdate|MonikerCredentialUpdate|CentralNicCredentialUpdate|NicManagerCredentialUpdate|OpusDnsCredentialUpdate|EnomCredentialUpdate|OpenSrsCredentialUpdate|NicDirectCredentialUpdate|OpenproviderCredentialUpdate|RealtimeRegisterCredentialUpdate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function updateCredential(
        string $registrarCredentialId,
        InternetXCredentialUpdate|DomainBestellsystemCredentialUpdate|MonikerCredentialUpdate|CentralNicCredentialUpdate|NicManagerCredentialUpdate|OpusDnsCredentialUpdate|EnomCredentialUpdate|OpenSrsCredentialUpdate|NicDirectCredentialUpdate|OpenproviderCredentialUpdate|RealtimeRegisterCredentialUpdate|array $body,
        ?string $xDatetimeFormat = null,
    ): RegistrarCredential {
        $response = $this->client->request(
            'PUT',
            Endpoint::CONNECT_REGISTRARS_BY_REGISTRAR_CREDENTIAL_ID,
            path: ['registrar_credential_id' => $registrarCredentialId],
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): RegistrarCredential => RegistrarCredential::fromArray($data));
    }

    /**
     * Disconnect a registrar account
     *
     * Cancels a running sync and removes the account. Everything its syncs brought into OpusDNS is removed
     * in the background. Nothing changes at the registrar.
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:delete
     *
     * @param string $registrarCredentialId ID of the connected registrar account
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function deleteCredential(string $registrarCredentialId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::CONNECT_REGISTRARS_BY_REGISTRAR_CREDENTIAL_ID,
            path: ['registrar_credential_id' => $registrarCredentialId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Get sync status
     *
     * Shows the account's latest sync. Poll it until `status` is `completed`, `failed` or `cancelled`.
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:read
     *
     * @param string $registrarCredentialId ID of the connected registrar account
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function getSyncStatus(string $registrarCredentialId, ?string $xDatetimeFormat = null): SyncStatus
    {
        $response = $this->client->request(
            'GET',
            Endpoint::CONNECT_REGISTRARS_BY_REGISTRAR_CREDENTIAL_ID_SYNC,
            path: ['registrar_credential_id' => $registrarCredentialId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): SyncStatus => SyncStatus::fromArray($data));
    }

    /**
     * Start a sync
     *
     * Reads the account's domains from the registrar into your portfolio. If a sync is already running or
     * just finishing, it is returned with `200` instead of starting another.
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:manage
     *
     * @param string $registrarCredentialId ID of the connected registrar account
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function syncCredential(string $registrarCredentialId, ?string $xDatetimeFormat = null): SyncStatus
    {
        $response = $this->client->request(
            'POST',
            Endpoint::CONNECT_REGISTRARS_BY_REGISTRAR_CREDENTIAL_ID_SYNC,
            path: ['registrar_credential_id' => $registrarCredentialId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): SyncStatus => SyncStatus::fromArray($data));
    }

    /**
     * Cancel a sync
     *
     * Stops the sync in progress. Succeeds even when none is running.
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:manage
     *
     * @param string $registrarCredentialId ID of the connected registrar account
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function cancelSync(string $registrarCredentialId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::CONNECT_REGISTRARS_BY_REGISTRAR_CREDENTIAL_ID_SYNC,
            path: ['registrar_credential_id' => $registrarCredentialId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * List sync failures
     *
     * Lists the domains the latest sync could not sync, sorted by domain name. Each one has an `error`
     * with a `code`, a `detail` sentence and, when the registrar answered, its own response. Right after a
     * new sync starts, the list can still belong to the previous one: compare `batch_id` with **Get sync
     * status**.
     *
     * Required permissions: ai_concierge:manage, registrar_credentials:read
     *
     * @param string $registrarCredentialId ID of the connected registrar account
     * @param int|null $page Server default: 1.
     * @param int|null $pageSize Server default: 10.
     * @param string|null $xDatetimeFormat Deprecated: has no effect and will be removed from this specification on
     *     2026-11-12; the API keeps ignoring it if sent. Response datetimes are always normalized to UTC and
     *     serialized as RFC 3339 with a `Z` suffix.
     */
    public function listSyncFailures(
        string $registrarCredentialId,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $xDatetimeFormat = null,
    ): PaginationSyncFailure {
        $response = $this->client->request(
            'GET',
            Endpoint::CONNECT_REGISTRARS_BY_REGISTRAR_CREDENTIAL_ID_SYNC_FAILURES,
            path: ['registrar_credential_id' => $registrarCredentialId],
            query: ['page' => $page, 'page_size' => $pageSize],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PaginationSyncFailure => PaginationSyncFailure::fromArray($data));
    }
}
