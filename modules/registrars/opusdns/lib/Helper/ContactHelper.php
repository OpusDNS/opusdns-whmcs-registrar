<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

use OpusDNS\Client\Enum\DomainContactType;
use OpusDNS\Client\Model\ContactCreate;
use OpusDNS\Client\Model\ContactResponse;
use OpusDNS\Client\Model\DomainResponse;

/**
 * Maps contacts between the WHMCS registrar parameters and the OpusDNS contact models.
 */
class ContactHelper
{
    /**
     * Strips everything but digits and the leading plus sign, and adds the plus sign when it is missing.
     */
    public static function normalizePhone(string $phone): string
    {
        $digits = (string) preg_replace('/[^\d+]/', '', $phone);

        if ($digits !== '' && !str_starts_with($digits, '+')) {
            return '+' . $digits;
        }

        return $digits;
    }

    /**
     * The registrant contact from the parameters of a registration or transfer.
     *
     * @param array<string, mixed> $params
     */
    public static function createFromParams(array $params): ContactCreate
    {
        return new ContactCreate(
            city: (string) ($params['city'] ?? ''),
            country: (string) ($params['country'] ?? ''),
            disclose: false,
            email: (string) ($params['email'] ?? ''),
            firstName: (string) ($params['firstname'] ?? ''),
            lastName: (string) ($params['lastname'] ?? ''),
            phone: self::normalizePhone((string) ($params['fullphonenumber'] ?? '')),
            postalCode: (string) ($params['postcode'] ?? ''),
            street: (string) ($params['address1'] ?? ''),
            org: self::nullIfEmpty($params['companyname'] ?? null),
            state: self::nullIfEmpty($params['state'] ?? null),
        );
    }

    /**
     * A contact from the details submitted through the WHMCS contact details form.
     *
     * @param array<string, mixed> $details
     */
    public static function createFromWhmcsDetails(array $details): ContactCreate
    {
        return new ContactCreate(
            city: (string) ($details['City'] ?? ''),
            country: (string) ($details['Country'] ?? ''),
            disclose: false,
            email: (string) ($details['Email Address'] ?? ''),
            firstName: (string) ($details['First Name'] ?? ''),
            lastName: (string) ($details['Last Name'] ?? ''),
            phone: self::normalizePhone((string) ($details['Phone Number'] ?? '')),
            postalCode: (string) ($details['Postcode'] ?? ''),
            street: implode(', ', array_filter([
                (string) ($details['Address 1'] ?? ''),
                (string) ($details['Address 2'] ?? ''),
            ])),
            org: self::nullIfEmpty($details['Company Name'] ?? null),
            state: self::nullIfEmpty($details['State'] ?? null),
        );
    }

    /**
     * The contact fields in the layout WHMCS expects from GetContactDetails.
     *
     * @return array<string, string>
     */
    public static function toWhmcsArray(ContactResponse $contact): array
    {
        return [
            'First Name' => $contact->firstName,
            'Last Name' => $contact->lastName,
            'Company Name' => $contact->org ?? '',
            'Email Address' => $contact->email,
            'Address 1' => $contact->street,
            'Address 2' => '',
            'City' => $contact->city,
            'State' => $contact->state ?? '',
            'Postcode' => $contact->postalCode,
            'Country' => strtoupper($contact->country),
            'Phone Number' => self::normalizePhone($contact->phone),
        ];
    }

    /**
     * The id of the registrant contact of a domain, or null when the domain has none.
     */
    public static function registrantContactId(DomainResponse $domain): ?string
    {
        foreach ($domain->contacts ?? [] as $contact) {
            if ($contact->contactType === DomainContactType::REGISTRANT) {
                return $contact->contactId;
            }
        }

        return null;
    }

    private static function nullIfEmpty(mixed $value): ?string
    {
        $string = trim((string) ($value ?? ''));

        return $string === '' ? null : $string;
    }
}
