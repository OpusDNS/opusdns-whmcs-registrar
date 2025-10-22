<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Service\BaseService;
use WHMCS\Module\Registrar\OpusDNS\Models\Contact;

class Contacts extends BaseService
{
    protected const MODEL_CLASS = Contact::class;
    
    public function list(array $options = []): ApiResponse
    {
        return $this->getResource('/contacts', $options);
    }
    
    public function create(array $attributes): ApiResponse
    {
        return $this->postResource('/contacts', $attributes);
    }
    
    public function getById(string $contactId): ApiResponse
    {
        return $this->getResource("/contacts/{$contactId}");
    }
    
    public function delete(string $contactId): void
    {
        $this->deleteResource("/contacts/{$contactId}");
    }
}
