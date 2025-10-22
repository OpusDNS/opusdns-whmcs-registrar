<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class DomainAvailability
{
    use ModelTrait;
    
    private string $domain_name = '';
    
    private bool $available = false;
    
    private ?string $reason = null;
    
    public function __construct(array $data = [])
    {
        $this->domain_name = (string)($data['domain_name'] ?? '');
        $this->available = (bool)($data['available'] ?? false);
        $this->reason = isset($data['reason']) ? (string)$data['reason'] : null;
    }
    
    public function getDomainName(): string
    {
        return $this->domain_name;
    }
    
    public function isAvailable(): bool
    {
        return $this->available;
    }
    
    public function getReason(): ?string
    {
        return $this->reason;
    }
}
