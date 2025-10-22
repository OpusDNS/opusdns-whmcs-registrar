<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class DomainSearchSuggestion
{
    use ModelTrait;
    
    private string $domain = '';
    
    private bool $available = false;
    
    private bool $premium = false;
    
    public function __construct(array $data = [])
    {
        $this->domain = (string)($data['domain'] ?? '');
        $this->available = (bool)($data['available'] ?? false);
        $this->premium = (bool)($data['premium'] ?? false);
    }
    
    public function getDomain(): string
    {
        return $this->domain;
    }
    
    public function isAvailable(): bool
    {
        return $this->available;
    }
    
    public function isPremium(): bool
    {
        return $this->premium;
    }
}
