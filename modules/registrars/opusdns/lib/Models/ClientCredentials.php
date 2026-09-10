<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class ClientCredentials
{
    use ModelTrait;

    private string $api_key_id = '';
    private string $api_key_name = '';
    private ?string $api_key_description = null;
    private string $organization_id = '';
    private string $role = '';
    private string $status = '';
    private ?\DateTimeImmutable $created_on = null;
    private ?\DateTimeImmutable $deleted_on = null;
    private ?\DateTimeImmutable $expires_at = null;
    private ?\DateTimeImmutable $last_used_on = null;

    public function __construct(array $data = [])
    {
        $this->api_key_id = isset($data['api_key_id']) ? (string)$data['api_key_id'] : '';
        $this->api_key_name = isset($data['api_key_name']) ? (string)$data['api_key_name'] : '';
        $this->api_key_description = isset($data['api_key_description']) ? (string)$data['api_key_description'] : null;
        $this->organization_id = isset($data['organization_id']) ? (string)$data['organization_id'] : '';
        $this->role = isset($data['role']) ? (string)$data['role'] : '';
        $this->status = isset($data['status']) ? (string)$data['status'] : '';
        $this->created_on = $this->parseDateField($data, 'created_on');
        $this->deleted_on = $this->parseDateField($data, 'deleted_on');
        $this->expires_at = $this->parseDateField($data, 'expires_at');
        $this->last_used_on = $this->parseDateField($data, 'last_used_on');
    }

    public function getApiKeyId(): string
    {
        return $this->api_key_id;
    }

    public function getApiKeyName(): string
    {
        return $this->api_key_name;
    }

    public function getApiKeyDescription(): ?string
    {
        return $this->api_key_description;
    }

    public function getOrganizationId(): string
    {
        return $this->organization_id;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function getCreatedOn(): ?\DateTimeImmutable
    {
        return $this->created_on;
    }

    public function getDeletedOn(): ?\DateTimeImmutable
    {
        return $this->deleted_on;
    }

    public function getExpiresAt(): ?\DateTimeImmutable
    {
        return $this->expires_at;
    }

    public function getLastUsedOn(): ?\DateTimeImmutable
    {
        return $this->last_used_on;
    }
}
