<?php

/**
 * OpusDNS Registrar Module for WHMCS
 *
 * This module provides domain registration, transfer, and management functionality
 * using the OpusDNS API.
 * 
 * @package    WHMCS\Module\Registrar\OpusDNS
 * @author     Zoltan Egresi <zoltan.egresi@opusdns.com>
 */


if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Domains\DomainLookup\ResultsList;
use WHMCS\Domains\DomainLookup\SearchResult;
use WHMCS\Carbon;
use WHMCS\Domain\Registrar\Domain;
use WHMCS\Module\Registrar\OpusDNS\ApiClient;
use WHMCS\Module\Registrar\OpusDNS\Enum\PeriodUnit;
use WHMCS\Module\Registrar\OpusDNS\Enum\RenewalMode;
use WHMCS\Module\Registrar\OpusDNS\ApiException;
use WHMCS\Module\Registrar\OpusDNS\Enum\ProductAction;
use WHMCS\Module\Registrar\OpusDNS\Enum\ProductType;
use WHMCS\Module\Registrar\OpusDNS\Models\Contact;

function opusdns_MetaData()
{
    return array(
        'DisplayName' => 'OpusDNS',
        'APIVersion' => '1.1',
    );
}

function opusdns_getConfigArray()
{
    return [
        'FriendlyName' => [
            'Type' => 'System',
            'Value' => 'OpusDNS',
        ],
        'Description' => [
            'Type' => 'System',
            'Value' => 'Your gateway to a seamless domain management experience. Designed to simplify buying, selling, and managing domains.',
        ],
        'ClientID' => [
            'FriendlyName' => 'Client ID',
            'Type' => 'text',
            'Size' => '50',
            'Default' => '',
            'Description' => 'Enter your Client ID here',
        ],
        'ClientSecret' => [
            'FriendlyName' => 'Client Secret',
            'Type' => 'password',
            'Size' => '50',
            'Default' => '',
            'Description' => 'Enter your Client Secret here',
        ],
        'TestMode' => [
            'FriendlyName' => 'Test Mode',
            'Type' => 'yesno',
            'Description' => 'Tick to enable',
        ],

    ];
}

/**
 * Initialize API client with credentials from params
 *
 */
function opusdns_initApiClient(array $params): ApiClient
{
    return ApiClient::create([
        'ClientID' => $params['ClientID'],
        'ClientSecret' => $params['ClientSecret'],
        'TestMode' => $params['TestMode'],
    ]);
}

/**
 * Register a domain.
 *
 * Attempt to register a domain with the domain registrar.
 *
 * This is triggered when the following events occur:
 * * Payment received for a domain registration order
 * * When a pending domain registration order is accepted
 * * Upon manual request by an admin user
 *
 */
function opusdns_RegisterDomain($params)
{
    $domainName = $params['domain'];
    $tld = $params['tld'];

    try {
        $api = opusdns_initApiClient($params);
        $tldInfo = $api->tlds()->getTld($tld);

        if (!$tldInfo) {
            return ['error' => "TLD .{$tld} is not supported"];
        }
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }

    try {
        $api = opusdns_initApiClient($params);
        $contactData = $api->contacts()->buildContactDataFromParams($params);
        $createdContact = $api->contacts()->create($contactData)->getData();
        $contactId = $createdContact->getContactId();
    } catch (ApiException $e) {
        $errors = $e->getErrors() ?? [];
        if ($errors) {
            $errorMessages = [];
            foreach ($errors as $field => $messages) {
                $errorMessages[] = "Contact Field: {$field} - " . implode(', ', (array)$messages);
            }
            return ['error' => implode(', ', $errorMessages)];
        }
        return ['error' => $e->getMessage()];
    }

    $contacts = $tldInfo->buildContactsArray($contactId);

    $nameservers = array_filter([
        ['hostname' => $params['ns1'] ?? null],
        ['hostname' => $params['ns2'] ?? null],
        ['hostname' => $params['ns3'] ?? null],
        ['hostname' => $params['ns4'] ?? null],
        ['hostname' => $params['ns5'] ?? null],
    ], function ($ns) {
        return !empty($ns['hostname']);
    });

    $domainData = [
        'name' => $domainName,
        'period' => ['value' => (int)$params['regperiod'], 'unit' => PeriodUnit::YEAR->value],
        'contacts' => $contacts,
        'nameservers' => $nameservers,
        'renewal_mode' => RenewalMode::EXPIRE,
    ];

    try {
        $api = opusdns_initApiClient($params);
        $api->domains()->create($domainData);
        return ['success' => true];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Renew a domain.
 *
 * Attempt to renew/extend a domain for a given number of years.
 *
 * This is triggered when the following events occur:
 * * Payment received for a domain renewal order
 * * When a pending domain renewal order is accepted
 * * Upon manual request by an admin user
 *
 */
function opusdns_RenewDomain($params)
{
    $domainName = $params['domain'];
    $tld = $params['tld'];
    $renewPeriod = (int)$params['regperiod'];
    $whmcsExpiryDate = $params['expiryDate'];

    try {
        $api = opusdns_initApiClient($params);
        $tldInfo = $api->tlds()->getTld($tld);

        if (!$tldInfo) {
            return ['error' => "TLD .{$tld} is not supported"];
        }

        $domainInfo = $api->domains()->getByName($domainName)->getData();
        $registryExpiryDate = $domainInfo->getExpiresOn();

        $whmcsDate = $whmcsExpiryDate->format('Y-m-d');
        $registryDate = $registryExpiryDate->format('Y-m-d');

        if ($whmcsDate !== $registryDate) {
            return ['error' => "Date mismatch: WHMCS has {$whmcsDate}, Registry has {$registryDate}. Please sync the domain first."];
        }

        if ($tldInfo->supportsExplicitRenewal()) {
            $renewRequest = [
                'period' => ['value' => $renewPeriod, 'unit' => PeriodUnit::YEAR->value],
                'current_expiry_date' => $registryExpiryDate->format('Y-m-d\TH:i:s')
            ];
            $api->domains()->renew($domainName, $renewRequest);
        } else {
            $api->domains()->update($domainName, ['renewal_mode' => RenewalMode::RENEW->value]);
        }

        return ['success' => true];
    } catch (ApiException $e) {
        if (is_array($e->getErrors())) {
            $errorMessages = [];
            foreach ($e->getErrors() as $field => $messages) {
                $errorMessages[] = "Field: {$field} - " . implode(', ', (array)$messages);
            }
            return ['error' => implode(', ', $errorMessages)];
        } else {
            return ['error' => $e->getMessage()];
        }
    }
}


function opusdns_GetDomainInformation($params)
{
    $domainName = $params['domain'];

    try {
        $api = opusdns_initApiClient($params);
        $response = $api->domains()->getByName($domainName)->getData();
    } catch (ApiException $e) {
        return [
            'error' => $e->getMessage(),
        ];
    }

    $nameservers = [];
    $i = 1;
    $responseNameservers = $response->getNameservers();
    if ($responseNameservers) {
        foreach ($responseNameservers as $nameserver) {
            $nameservers["ns" . $i] = $nameserver['hostname'] ?? '';
            $i++;
        }
    }

    $domain = new Domain();
    $domain->setIsIrtpEnabled(false);
    $domain->setDomain($response->getName());
    $domain->setNameservers($nameservers);
    $domain->setExpiryDate(Carbon::parse($response->getExpiresOn()->format('Y-m-d H:i:s')));
    $domain->setTransferLock($response->isTransferLocked() ?? false);

    return $domain;
}

/**
 * Fetch current nameservers.
 *
 * This function should return an array of nameservers for a given domain.
 *
 */
function opusdns_GetNameservers($params) {}

/**
 * Save nameserver changes.
 *
 * This function should submit a change of nameservers request to the
 * domain registrar.
 *
 */
function opusdns_SaveNameservers($params)
{
    $domainName = $params['domain'];
    $nameservers = [];

    for ($i = 1; $i <= 5; $i++) {
        $ns = $params['ns' . $i] ?? null;
        if (!empty($ns)) {
            $nameservers[] = ['hostname' => $ns];
        }
    }

    if (empty($nameservers)) {
        return [
            'error' => 'No nameservers provided for update.',
        ];
    }

    try {
        $api = opusdns_initApiClient($params);
        $api->domains()->update($domainName, ['nameservers' => $nameservers]);
        return ['success' => true];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

function opusdns_GetContactDetails($params)
{
    try {
        $api = opusdns_initApiClient($params);
        $domain = $api->domains()->getByName($params['domain'])->getData();
        $contacts = $domain->getContacts();

        foreach ($contacts as $contact) {
            $contactId = $contact['contact_id'] ?? null;
            $contactType = strtolower($contact['contact_type'] ?? '');

            if ($contactId && $contactType === 'registrant') {
                return ['Registrant' => $api->contacts()->getContactInfo($contactId)];
            }
        }

        return ['error' => 'Registrant contact not found'];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

function opusdns_SaveContactDetails($params)
{
    $submittedData = $params['contactdetails']['Registrant'] ?? null;

    if (!$submittedData) {
        return ['error' => 'Registrant contact data is required'];
    }

    try {
        $api = opusdns_initApiClient($params);
        $tld = $params['tld'];
        $tldInfo = $api->tlds()->getTld($tld);

        if (!$tldInfo) {
            return ['error' => "TLD .{$tld} is not supported"];
        }

        $tldContacts = $tldInfo->getContacts();
        $registrantChange = $tldContacts['registrant_change'] ?? null;

        if ($registrantChange !== 'update') {
            return ['error' => 'Contact updates are not supported for this TLD'];
        }

        $domain = $api->domains()->getByName($params['domain'])->getData();
        $contacts = $domain->getContacts();

        $registrantContactId = null;
        foreach ($contacts as $contact) {
            if (strtolower($contact['contact_type'] ?? '') === 'registrant') {
                $registrantContactId = $contact['contact_id'] ?? null;
                break;
            }
        }

        if (!$registrantContactId) {
            return ['error' => 'Registrant contact not found'];
        }

        $currentData = $api->contacts()->getContactInfo($registrantContactId);
        $filteredSubmittedData = array_intersect_key($submittedData, $currentData);

        if (isset($filteredSubmittedData['Phone Number'])) {
            $filteredSubmittedData['Phone Number'] = Contact::normalizePhone($filteredSubmittedData['Phone Number']);
        }

        $differences = array_diff_assoc($filteredSubmittedData, $currentData);

        if (empty($differences)) {
            return ['success' => true];
        }

        $newContactId = $api->contacts()->createContactFromWhmcsDetails($submittedData);
        $newContacts = $tldInfo->buildContactsArray($newContactId);

        $api->domains()->update($params['domain'], ['contacts' => $newContacts]);

        return ['success' => true];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Check Domain Availability.
 *
 * Determine if a domain or group of domains are available for
 * registration or transfer.
 *
 */
function opusdns_CheckAvailability($params)
{
    $searchTerm = strtolower($params['searchTerm']);
    $domainsToCheck = array_map(fn($tld) => $searchTerm . $tld, $params['tldsToInclude']);

    try {
        $api = opusdns_initApiClient($params);
        $results = new ResultsList();
        $apiAvailabilityResults = $api->availability()->bulk($domainsToCheck)->getResults();

        foreach ($apiAvailabilityResults as $item) {
            $domainObj = new \WHMCS\Domains\Domain($item->getDomain());
            $searchResult = SearchResult::factoryFromDomain($domainObj);
            $searchResult->setStatus($item->isAvailable() ? SearchResult::STATUS_NOT_REGISTERED : SearchResult::STATUS_REGISTERED);
            $results->append($searchResult);
        }

        return $results;
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Domain Suggestion Settings.
 *
 * Defines the settings relating to domain suggestions (optional).
 * It follows the same convention as `getConfigArray`.
 *
 */
function opusdns_DomainSuggestionOptions()
{
    return [
        'maxDomainSuggestionsResults' => [
            'FriendlyName' => 'Maximum Results',
            'Type' => 'text',
            'Size' => '5',
            'Default' => '25',
            'Description' => 'The maximum number of domain suggestions to return (1-100).',
        ],
    ];
}

/**
 * Get Domain Suggestions.
 *
 * Provide domain suggestions based on the domain lookup term provided.
 *
 */
function opusdns_GetDomainSuggestions($params)
{
    $suggestionSettings = $params['suggestionSettings'];
    $searchTerm = $params['searchTerm'];
    $tldsToInclude = array_map(fn($tld) => ltrim($tld, '.'), $params['tldsToInclude']);
    $limit = min(100, max(1, (int)($suggestionSettings['maxDomainSuggestionsResults'] ?? 25)));
    $includePremium = false;

    try {
        $api = opusdns_initApiClient($params);
        $results = new ResultsList();

        $apiSuggestionResults = $api->domainSearch()->suggest($searchTerm, [
            'tlds' => $tldsToInclude,
            'limit' => $limit,
            'premium' => $includePremium,
        ])->getResults();

        foreach ($apiSuggestionResults as $item) {
            $domainObj = new \WHMCS\Domains\Domain($item->getDomain());
            $searchResult = SearchResult::factoryFromDomain($domainObj);
            $searchResult->setStatus($item->isAvailable() ? SearchResult::STATUS_NOT_REGISTERED : SearchResult::STATUS_REGISTERED);
            $results->append($searchResult);
        }

        return $results;
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

function opusdns_GetRegistrarLock($params) {}

/**
 * Set registrar lock status.
 *
 * Also known as Domain Lock or Transfer Lock status.
 */
function opusdns_SaveRegistrarLock($params)
{
    $domainName = $params['domain'];
    $isLocked = $params['lockenabled'] === 'locked';

    try {
        $api = opusdns_initApiClient($params);
        $statuses = $isLocked ? ['clientTransferProhibited'] : [];
        $api->domains()->update($domainName, ['statuses' => $statuses]);
        return ['success' => true];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}



/**
 * Request EEP Code.
 *
 * Supports both displaying the EPP Code directly to a user or indicating
 * that the EPP Code will be emailed to the registrant.
 *
 */
function opusdns_GetEPPCode($params)
{
    $domainName = $params['domain'];
    try {
        $api = opusdns_initApiClient($params);
        $response = $api->domains()->getByName($domainName)->getData();
        return ['eppcode' => $response->getAuthCode()];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}


/**
 * Delete Domain.
 *
 */
function opusdns_RequestDelete($params)
{
    $domainName = $params['domain'];
    try {
        $api = opusdns_initApiClient($params);
        $api->domains()->delete($domainName);
        return ['success' => true];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}


/**
 * Sync Domain Status & Expiration Date.
 *
 * Domain syncing is intended to ensure domain status and expiry date
 * changes made directly at the domain registrar are synced to WHMCS.
 * It is called periodically for a domain.
 *
 */
function opusdns_Sync($params)
{
    $domainName = $params['domain'];
    try {
        $api = opusdns_initApiClient($params);
        $response = $api->domains()->getByName($domainName)->getData();
        return [
            'expirydate' => $response->getExpiresOn()->format('Y-m-d'),
        ];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

function opusdns_GetTldPricing($params)
{
    try {
        $api = opusdns_initApiClient($params);
        $tldGroups = $api->tlds()->getTlds();
        $prices = $api->pricing()->getPrices($params['ClientID'], ProductType::DOMAIN);

        $results = new \WHMCS\Results\ResultsList();

        $pricesByTld = [];
        foreach ($prices as $price) {
            $productClass = $price->getProductClass();
            $productAction = $price->getProductAction();
            $period = $price->getPeriod();

            if (!$productClass || !$productAction) {
                continue;
            }

            $periodValue = $period['value'] ?? null;
            $periodUnit = $period['unit'] ?? null;

            if ($periodValue !== 1 || $periodUnit !== PeriodUnit::YEAR->value) {
                continue;
            }

            if (!isset($pricesByTld[$productClass])) {
                $pricesByTld[$productClass] = [
                    'currency' => $price->getCurrency(),
                ];
            }

            $pricesByTld[$productClass][$productAction] = $price->getPrice();
        }

        foreach ($tldGroups as $tldGroup) {
            if (!$tldGroup->isEnabled()) {
                continue;
            }

            foreach ($tldGroup->getTlds() as $tld) {
                $tldName = $tld['name'] ?? null;
                if (!$tldName) {
                    continue;
                }

                if (!isset($pricesByTld[$tldName])) {
                    continue;
                }

                $tldPricing = $pricesByTld[$tldName];
                $registrationYears = $tldGroup->getRegistrationYears();
                $minYears = $tldGroup->getMinRegistrationYears();
                $registerPrice = ($tldPricing[ProductAction::CREATE->value] ?? 0) * $minYears;
                $renewPrice = isset($tldPricing[ProductAction::RENEW->value]) ? $tldPricing[ProductAction::RENEW->value] * $minYears : null;
                $transferPrice = isset($tldPricing[ProductAction::TRANSFER->value]) ? $tldPricing[ProductAction::TRANSFER->value] * $minYears : null;
                $graceDays = $tldGroup->getGracePeriodDays();
                $redemptionDays = $tldGroup->getRedemptionPeriodDays();
                $eppRequired = $tldGroup->isAuthInfoRequired();

                $item = (new \WHMCS\Domain\TopLevel\ImportItem())
                    ->setExtension('.' . $tldName)
                    ->setYears($registrationYears)
                    ->setRegisterPrice($registerPrice)
                    ->setRenewPrice($renewPrice)
                    ->setTransferPrice($transferPrice)
                    ->setGraceFeeDays($graceDays)
                    ->setGraceFeePrice($graceDays > 0 ? 0 : null)
                    ->setRedemptionFeeDays($redemptionDays)
                    ->setRedemptionFeePrice($tldPricing[ProductAction::RESTORE->value] ?? null)
                    ->setCurrency($tldPricing['currency'])
                    ->setEppRequired($eppRequired);

                $results[] = $item;
            }
        }
        return $results;
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

function opusdns_ClientAreaCustomButtonArray($params)
{
    $buttons = [];

    return $buttons;
}

function opusdns_ClientAreaAllowedFunctions($params)
{
    $functions = [];
    return $functions;
}
