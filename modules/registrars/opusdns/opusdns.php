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

function opusdns_MetaData()
{
    return array(
        'DisplayName' => 'OpusDNS',
        'APIVersion' => '1.1',
        'NonLinearRegistrationPricing' => true,
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
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 */
function opusdns_RegisterDomain($params)
{

    $api = opusdns_initApiClient($params);

    $contactData = [
        'first_name' => $params["firstname"],
        'last_name' => $params["lastname"],
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

    try {
        $createdContact = $api->contacts()->create($contactData)->getData();
        $contactId = $createdContact->getContactId();
        $contacts = [
            'registrant' => [['contact_id' => $contactId]],
            'admin' => [['contact_id' => $contactId]],
            'tech' => [['contact_id' => $contactId]],
        ];
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
        'name' => $params['sld'] . '.' . $params['tld'],
        'period' => ['value' => (int)$params['regperiod'], 'unit' => PeriodUnit::YEAR],
        'contacts' => $contacts,
        'nameservers' => $nameservers,
        'renewal_mode' => RenewalMode::EXPIRE,
    ];

    try {
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
    $renewPeriod = (int)$params['regperiod'];
    $whmcsExpiryDate = $params['expiryDate'];

    try {
        $api = opusdns_initApiClient($params);
        $domainInfo = $api->domains()->getByName($domainName)->getData();
        $registryExpiryDate = $domainInfo->getExpiresOn();

        $whmcsDate = $whmcsExpiryDate->format('Y-m-d');
        $registryDate = $registryExpiryDate->format('Y-m-d');

        if ($whmcsDate !== $registryDate) {
            return ['error' => "Date mismatch: WHMCS has {$whmcsDate}, Registry has {$registryDate}. Please sync the domain first."];
        }

        $renewRequest = [
            'period' => ['value' => $renewPeriod, 'unit' => PeriodUnit::YEAR->value],
            'current_expiry_date' => $registryExpiryDate->format('Y-m-d\TH:i:s')
        ];

        $api->domains()->renew($domainName, $renewRequest);
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
    $api = opusdns_initApiClient($params);

    try {
        $response = $api->domains()->getByName($params['sld'] . '.' . $params['tld'])->getData();
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
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 */
function opusdns_GetNameservers($params) {}

/**
 * Save nameserver changes.
 *
 * This function should submit a change of nameservers request to the
 * domain registrar.
 *
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 */
function opusdns_SaveNameservers($params)
{

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
        $api->domains()->update(
            $params['sld'] . '.' . $params['tld'],
            ['nameservers' => $nameservers]
        );
        // If the update was successful, return success
        return array(
            'success' => true,
        );
    } catch (ApiException $e) {
        return array(
            'error' => $e->getMessage(),
        );
    }
}

/**
 * Check Domain Availability.
 *
 * Determine if a domain or group of domains are available for
 * registration or transfer.
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @see \WHMCS\Domains\DomainLookup\SearchResult
 * @see \WHMCS\Domains\DomainLookup\ResultsList
 *
 * @throws Exception Upon domain availability check failure.
 *
 */
function opusdns_CheckAvailability($params)
{
    $searchTerm = strtolower($params['searchTerm']);
    $tldsToInclude = $params['tldsToInclude'];
    $domains = [];

    foreach (array_chunk($tldsToInclude, 10) as $tlds) {
        foreach ($tlds as $tld) {
            $domains[] = [
                'domain_name' => $searchTerm . $tld,
                'sld' => $searchTerm,
                'tld' => $tld,
            ];
        }
    }

    try {
        $api = opusdns_initApiClient($params);
        $results = new ResultsList();
        $domainsToCheck = array_map(function ($domain) {
            return $domain['domain_name'];
        }, $domains);
        $apiCheck = $api->domains()->check($domainsToCheck)->getData();

        foreach ($domains as $domain) {
            $searchResult = new SearchResult($domain['sld'], $domain['tld']);

            $domainApiCheckStatus = null;
            foreach ($apiCheck as $item) {
                if ($item->getDomainName() === $domain['domain_name']) {
                    $domainApiCheckStatus = $item;
                    break;
                }
            }

            if (!$domainApiCheckStatus) {
                $searchResult->setStatus(SearchResult::STATUS_TLD_NOT_SUPPORTED);
            } elseif ($domainApiCheckStatus->isAvailable()) {
                $searchResult->setStatus(SearchResult::STATUS_NOT_REGISTERED);
            } else {
                $searchResult->setStatus(SearchResult::STATUS_REGISTERED);
            }

            $results->append($searchResult);
        }
        return $results;
    } catch (ApiException $e) {
        return array(
            'error' => $e->getMessage(),
        );
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
    $domainName = $params['sld'] . '.' . $params['tld'];
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
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 *
 */
function opusdns_GetEPPCode($params)
{
    $api = opusdns_initApiClient($params);

    try {
        $response = $api->domains()->getByName($params['sld'] . '.' . $params['tld'])->getData();
        return ['eppcode' => $response->getAuthCode()];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}


/**
 * Delete Domain.
 *
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 */
function opusdns_RequestDelete($params)
{
    $api = opusdns_initApiClient($params);

    try {
        $api->domains()->delete($params['sld'] . '.' . $params['tld']);
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
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 */
function opusdns_Sync($params)
{
    $api = opusdns_initApiClient($params);

    try {
        $response = $api->domains()->getByName($params['sld'] . '.' . $params['tld'])->getData();
        return [
            'expirydate' => $response->getExpiresOn()->format('Y-m-d'),
            //'active' => $response->registry_statuses && in_array('active', $response->registry_statuses),
            //'transferredAway' => $response->registry_statuses && in_array('transferredAway', $response->registry_statuses),
        ];
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
