<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class Contact
{
    use ModelTrait;

    private ?string $contact_id = null;

    private ?string $organization_id = null;

    private ?string $title = null;

    private string $first_name = '';

    private string $last_name = '';

    private ?string $org = null;

    private string $email = '';

    private ?string $phone = null;

    private ?string $fax = null;

    private string $street = '';

    private string $city = '';

    private ?string $state = null;

    private string $postal_code = '';

    private string $country = '';

    private bool $disclose = false;

    private ?\DateTimeImmutable $created_on = null;

    private ?\DateTimeImmutable $deleted_on = null;
    
    public function __construct(array $data = [])
    {
        if (isset($data['email']) && empty(trim($data['email']))) {
            throw new \InvalidArgumentException('Contact email cannot be empty');
        }
        $this->contact_id = isset($data['contact_id']) ? (string)$data['contact_id'] : null;
        $this->organization_id = isset($data['organization_id']) ? (string)$data['organization_id'] : null;
        $this->title = isset($data['title']) ? (string)$data['title'] : null;
        $this->first_name = isset($data['first_name']) ? (string)$data['first_name'] : '';
        $this->last_name = isset($data['last_name']) ? (string)$data['last_name'] : '';
        $this->org = isset($data['org']) ? (string)$data['org'] : null;
        $this->email = isset($data['email']) ? (string)$data['email'] : '';
        $this->phone = isset($data['phone']) ? (string)$data['phone'] : null;
        $this->fax = isset($data['fax']) ? (string)$data['fax'] : null;
        $this->street = isset($data['street']) ? (string)$data['street'] : '';
        $this->city = isset($data['city']) ? (string)$data['city'] : '';
        $this->state = isset($data['state']) ? (string)$data['state'] : null;
        $this->postal_code = isset($data['postal_code']) ? (string)$data['postal_code'] : '';
        $this->country = isset($data['country']) ? (string)$data['country'] : '';
        $this->disclose = isset($data['disclose']) ? (bool)$data['disclose'] : false;
        $this->created_on = $this->parseDateField($data, 'created_on');
        $this->deleted_on = $this->parseDateField($data, 'deleted_on');
    }
    
    public function getContactId(): ?string
    {
        return $this->contact_id;
    }
    
    public function getOrganizationId(): ?string
    {
        return $this->organization_id;
    }
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    public function getFirstName(): string
    {
        return $this->first_name;
    }
    
    public function getLastName(): string
    {
        return $this->last_name;
    }
    
    public function getOrg(): ?string
    {
        return $this->org;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    
    public function getFax(): ?string
    {
        return $this->fax;
    }
    
    public function getStreet(): string
    {
        return $this->street;
    }
    
    public function getCity(): string
    {
        return $this->city;
    }
    
    public function getState(): ?string
    {
        return $this->state;
    }
    
    public function getPostalCode(): string
    {
        return $this->postal_code;
    }
    
    public function getCountry(): string
    {
        return $this->country;
    }
    
    public function isDisclose(): bool
    {
        return $this->disclose;
    }
    
    public function getCreatedOn(): ?\DateTimeImmutable
    {
        return $this->created_on;
    }
    
    public function getDeletedOn(): ?\DateTimeImmutable
    {
        return $this->deleted_on;
    }

    public static function normalizePhone(string $phone): string
    {
        if (!$phone) {
            return '';
        }

        $phone = preg_replace('/[^\d+]/', '', $phone);
        
        if ($phone && !str_starts_with($phone, '+')) {
            $phone = '+' . $phone;
        }

        return $phone;
    }

    public function toWhmcsArray(): array
    {
        $street = $this->getStreet();

        return [
            'First Name' => $this->getFirstName(),
            'Last Name' => $this->getLastName(),
            'Company Name' => $this->getOrg() ?? '',
            'Email Address' => $this->getEmail(),
            'Address 1' => is_array($street) ? ($street[0] ?? '') : $street,
            'Address 2' => is_array($street) ? ($street[1] ?? '') : '',
            'City' => $this->getCity(),
            'State' => $this->getState() ?? '',
            'Postcode' => $this->getPostalCode(),
            'Country' => strtoupper($this->getCountry()),
            'Phone Number' => self::normalizePhone($this->getPhone() ?? ''),
        ];
    }

    public static function fromWhmcsArray(array $details): array
    {
        $contactData = [
            'first_name' => $details['First Name'] ?? '',
            'last_name' => $details['Last Name'] ?? '',
            'email' => $details['Email Address'] ?? '',
            'street' => implode(', ', array_filter([
                $details['Address 1'] ?? '',
                $details['Address 2'] ?? '',
            ])),
            'city' => $details['City'] ?? '',
            'state' => $details['State'] ?? '',
            'postal_code' => $details['Postcode'] ?? '',
            'country' => $details['Country'] ?? '',
            'phone' => self::normalizePhone($details['Phone Number'] ?? ''),
            'disclose' => false,
        ];

        if (!empty($details['Company Name'])) {
            $contactData['org'] = $details['Company Name'];
        }

        return $contactData;
    }
}
