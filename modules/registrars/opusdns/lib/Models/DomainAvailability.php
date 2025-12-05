<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class DomainAvailability
{
    use ModelTrait;
    
    private string $domain = '';
    
    private string $status = '';
    
    public function __construct(array $data = [])
    {
        $this->domain = (string)($data['domain'] ?? '');
        $this->status = (string)($data['status'] ?? '');
    }
    
    public function getDomain(): string
    {
        return $this->domain;
    }
    
    public function getStatus(): string
    {
        return $this->status;
    }
    
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }
}
