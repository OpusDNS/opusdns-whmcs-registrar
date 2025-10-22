<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Service\BaseService;
use WHMCS\Module\Registrar\OpusDNS\Models\Domain;
use WHMCS\Module\Registrar\OpusDNS\Models\DomainAvailability;
use WHMCS\Module\Registrar\OpusDNS\Models\Response\DomainRenew;

class Domains extends BaseService
{
    protected const MODEL_CLASS = Domain::class;
    
    public function list(array $options = []): ApiResponse
    {
        return $this->getResource('/domains', $options);
    }
    
    public function create(array $attributes): ApiResponse
    {
        return $this->postResource('/domains', $attributes);
    }
    
    public function getByName(string $domainName): ApiResponse
    {
        return $this->getResource("/domains/{$domainName}");
    }
    
    public function update(string $domainName, array $attributes): ApiResponse
    {
        return $this->patchResource("/domains/{$domainName}", $attributes);
    }
    
    public function renew(string $domainName, array $attributes): ApiResponse
    {
        return $this->postResource("/domains/{$domainName}/renew", $attributes, DomainRenew::class);
    }
    
    public function transfer(array $attributes): ApiResponse
    {
        return $this->postResource("/domains/transfer", $attributes);
    }
    
    public function cancelTransfer(string $domainName): void
    {
        $this->deleteResource("/domains/{$domainName}/transfer");
    }
    
    public function delete(string $domainName): void
    {
        $this->deleteResource("/domains/{$domainName}");
    }
    
    public function check(array $domains): ApiResponse
    {
        return $this->getResource("/domains/check", ['domains' => $domains], DomainAvailability::class);
    }
}
