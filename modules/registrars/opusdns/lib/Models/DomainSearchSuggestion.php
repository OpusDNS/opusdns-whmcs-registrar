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
    
    private ?array $price = null;
    
    public function __construct(array $data = [])
    {
        $this->domain = (string)($data['domain'] ?? '');
        $this->available = (bool)($data['available'] ?? false);
        $this->premium = (bool)($data['premium'] ?? false);
        $this->price = $data['price'] ?? null;
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
    
    public function getPrice(): ?array
    {
        return $this->price;
    }
    
    public function getPriceAmount(): ?string
    {
        return $this->price['amount'] ?? null;
    }
    
    public function getPriceCurrency(): ?string
    {
        return $this->price['currency'] ?? null;
    }
}
