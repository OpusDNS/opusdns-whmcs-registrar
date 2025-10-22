<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models\Response;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class DomainRenew
{
    use ModelTrait;
    
    public string $name = '';
    
    public ?\DateTimeImmutable $new_expiry_date = null;
    
    public ?array $period_extended = null;
    
    public function __construct(array $data = [])
    {
        $this->name = isset($data['name']) ? (string)$data['name'] : '';
        $this->new_expiry_date = $this->parseDateField($data, 'new_expiry_date');
        $this->period_extended = isset($data['period_extended']) ? (array)$data['period_extended'] : null;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getNewExpiryDate(): ?\DateTimeImmutable
    {
        return $this->new_expiry_date;
    }
    
    public function getPeriodExtended(): ?array
    {
        return $this->period_extended;
    }
}
