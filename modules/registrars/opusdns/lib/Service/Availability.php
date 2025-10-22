<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Models\DomainAvailability;

class Availability extends BaseService
{
    protected const MODEL_CLASS = DomainAvailability::class;
    
    public function bulk(array $domains): ApiResponse
    {
        return $this->getResource('/availability', ['domains' => $domains]);
    }
    
    public function stream(array $domains): ApiResponse
    {
        return $this->getResource('/availability/stream', ['domains' => $domains], null);
    }
}
