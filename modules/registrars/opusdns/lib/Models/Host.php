<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use DateTimeImmutable;
use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class Host
{
    use ModelTrait;

    private string $host_id = '';

    private string $hostname = '';

    private array $ip_addresses = [];

    private ?DateTimeImmutable $created_on = null;

    private ?DateTimeImmutable $updated_on = null;

    public function __construct(array $data = [])
    {
        $this->host_id      = isset($data['host_id']) ? (string)$data['host_id'] : '';
        $this->hostname     = isset($data['hostname']) ? (string)$data['hostname'] : '';
        $this->ip_addresses = isset($data['ip_addresses']) && is_array($data['ip_addresses'])
            ? $data['ip_addresses']
            : [];
        $this->created_on = $this->parseDateField($data, 'created_on');
        $this->updated_on = $this->parseDateField($data, 'updated_on');
    }

    public function getHostId(): string
    {
        return $this->host_id;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function getIpAddresses(): array
    {
        return $this->ip_addresses;
    }

    public function getCreatedOn(): ?DateTimeImmutable
    {
        return $this->created_on;
    }

    public function getUpdatedOn(): ?DateTimeImmutable
    {
        return $this->updated_on;
    }
}
