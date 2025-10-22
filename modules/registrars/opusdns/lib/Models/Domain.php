<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;
use DateTimeImmutable;
use InvalidArgumentException;

class Domain
{
    use ModelTrait;
    
    private ?string $domain_id = null;
    
    private string $name = '';
    
    private string $sld = '';
    
    private string $tld = '';
    
    private string $roid = '';
    
    private ?string $renewal_mode = null;
    
    private ?string $auth_code = null;
    
    private ?string $auth_code_expires_on = null;
    
    private bool $transfer_lock = false;
    
    private ?array $contacts = null;
    
    private ?array $nameservers = null;
    
    private ?array $registry_statuses = null;
    
    private string $owner_id = '';
    
    private string $registry_account_id = '';
    
    private ?DateTimeImmutable $created_on = null;
    
    private ?DateTimeImmutable $updated_on = null;
    
    private ?DateTimeImmutable $registered_on = null;
    
    private ?DateTimeImmutable $expires_on = null;
    
    private ?DateTimeImmutable $canceled_on = null;
    
    private ?DateTimeImmutable $deleted_on = null;
    
    public function __construct(array $data = [])
    {
        if (isset($data['name']) && empty(trim($data['name']))) {
            throw new InvalidArgumentException('Domain name cannot be empty');
        }

        $this->domain_id = isset($data['domain_id']) ? (string)$data['domain_id'] : null;
        $this->name = isset($data['name']) ? (string)$data['name'] : '';
        $this->sld = isset($data['sld']) ? (string)$data['sld'] : '';
        $this->tld = isset($data['tld']) ? (string)$data['tld'] : '';
        $this->roid = isset($data['roid']) ? (string)$data['roid'] : '';
        $this->renewal_mode = isset($data['renewal_mode']) ? (string)$data['renewal_mode'] : null;
        $this->auth_code = isset($data['auth_code']) ? (string)$data['auth_code'] : null;
        $this->auth_code_expires_on = isset($data['auth_code_expires_on']) ? (string)$data['auth_code_expires_on'] : null;
        $this->transfer_lock = isset($data['transfer_lock']) ? (bool)$data['transfer_lock'] : false;

        $this->contacts = array_key_exists('contacts', $data) ? (is_array($data['contacts']) ? $data['contacts'] : [$data['contacts']]) : null;
        $this->nameservers = array_key_exists('nameservers', $data) ? (is_array($data['nameservers']) ? $data['nameservers'] : [$data['nameservers']]) : null;
        $this->registry_statuses = array_key_exists('registry_statuses', $data) ? (is_array($data['registry_statuses']) ? $data['registry_statuses'] : [$data['registry_statuses']]) : null;
        $this->owner_id = isset($data['owner_id']) ? (string)$data['owner_id'] : '';
        $this->registry_account_id = isset($data['registry_account_id']) ? (string)$data['registry_account_id'] : '';

        $this->created_on = $this->parseDateField($data, 'created_on');
        $this->updated_on = $this->parseDateField($data, 'updated_on');
        $this->registered_on = $this->parseDateField($data, 'registered_on');
        $this->expires_on = $this->parseDateField($data, 'expires_on');
        $this->canceled_on = $this->parseDateField($data, 'canceled_on');
        $this->deleted_on = $this->parseDateField($data, 'deleted_on');
    }
    
    public function getDomainId(): ?string
    {
        return $this->domain_id;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getSld(): string
    {
        return $this->sld;
    }
    
    public function getTld(): string
    {
        return $this->tld;
    }
    
    public function getRoid(): string
    {
        return $this->roid;
    }
    
    public function getRenewalMode(): ?string
    {
        return $this->renewal_mode;
    }
    
    public function getAuthCode(): ?string
    {
        return $this->auth_code;
    }
    
    public function getAuthCodeExpiresOn(): ?string
    {
        return $this->auth_code_expires_on;
    }
    
    public function isTransferLocked(): bool
    {
        return $this->transfer_lock;
    }
    
    public function getContacts(): ?array
    {
        return $this->contacts;
    }
    
    public function getNameservers(): ?array
    {
        return $this->nameservers;
    }
    
    public function getRegistryStatuses(): ?array
    {
        return $this->registry_statuses;
    }
    
    public function getOwnerId(): string
    {
        return $this->owner_id;
    }
    
    public function getRegistryAccountId(): string
    {
        return $this->registry_account_id;
    }
    
    public function getCreatedOn(): ?DateTimeImmutable
    {
        return $this->created_on;
    }
    
    public function getUpdatedOn(): ?DateTimeImmutable
    {
        return $this->updated_on;
    }
    
    public function getRegisteredOn(): ?DateTimeImmutable
    {
        return $this->registered_on;
    }
    
    public function getExpiresOn(): ?DateTimeImmutable
    {
        return $this->expires_on;
    }
    
    public function getCanceledOn(): ?DateTimeImmutable
    {
        return $this->canceled_on;
    }
    
    public function getDeletedOn(): ?DateTimeImmutable
    {
        return $this->deleted_on;
    }
}
