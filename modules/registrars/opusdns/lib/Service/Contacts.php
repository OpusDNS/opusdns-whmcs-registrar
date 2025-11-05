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

    public function buildContactDataFromParams(array $params): array
    {
        $contactData = [
            'first_name' => $params['firstname'],
            'last_name' => $params['lastname'],
            'email' => $params['email'],
            'street' => $params['address1'],
            'city' => $params['city'],
            'postal_code' => $params['postcode'],
            'country' => $params['country'],
            'disclose' => false,
        ];

        if (!empty($params['companyname'])) {
            $contactData['org'] = $params['companyname'];
        }

        if (!empty($params['fullphonenumber'])) {
            $phone = preg_replace('/[^\d+]/', '', $params['fullphonenumber']);
            if (!str_starts_with($phone, '+')) {
                $phone = '+' . $phone;
            }
            $contactData['phone'] = $phone;
        }

        if (!empty($params['state'])) {
            $contactData['state'] = $params['state'];
        }

        return $contactData;
    }
}
