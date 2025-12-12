<?php

declare(strict_types=1);

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
use WHMCS\Module\Registrar\OpusDNS\Helper\NameserverHelper;
use WHMCS\Module\Registrar\OpusDNS\Helper\ErrorHelper;

function opusdns_MetaData(): array
{
    return [
        'DisplayName' => 'OpusDNS',
        'APIVersion' => '1.1',
    ];
}

function opusdns_getConfigArray(): array
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
 * Load registrar module language file
 */
function opusdns_loadLanguage(): array
{
    global $CONFIG;

    $language = isset($_SESSION['Language']) ? $_SESSION['Language'] : $CONFIG['Language'];
    $langFile = __DIR__ . '/lang/' . $language . '.php';

    if (!file_exists($langFile)) {
        $langFile = __DIR__ . '/lang/english.php';
    }

    $_LANG = [];
    if (file_exists($langFile)) {
        include $langFile;
    }

    return $_LANG;
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
function opusdns_RegisterDomain(array $params): array
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
    $nameservers = NameserverHelper::extractFromParams($params);

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
 * Transfer a domain.
 *
 * Attempt to create a domain transfer request.
 *
 * This is triggered when the following events occur:
 * * Payment received for a domain transfer order
 * * When a pending domain transfer order is accepted
 * * Upon manual request by an admin user
 *
 */
function opusdns_TransferDomain(array $params): array
{
    $domainName = $params['domain'];
    $tld = $params['tld'];
    $authCode = $params['eppcode'] ?? $params['transfersecret'] ?? '';

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
    $nameservers = NameserverHelper::extractFromParams($params);

    $transferData = [
        'name' => $domainName,
        'auth_code' => $authCode,
        'contacts' => $contacts,
        'nameservers' => array_values($nameservers),
        'renewal_mode' => RenewalMode::EXPIRE->value,
    ];

    try {
        $api = opusdns_initApiClient($params);
        $api->domains()->transfer($transferData);
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
function opusdns_RenewDomain(array $params): array
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

        if (!$registryExpiryDate) {
            return ['error' => 'Domain has no registry expiry date (may be pending transfer)'];
        }

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


function opusdns_GetDomainInformation(array $params): Domain | array
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

    $domain = new Domain();
    $domain->setIsIrtpEnabled(false);
    $domain->setDomain($response->getName());
    $domain->setNameservers($response->getNameserversForWhmcs());
    $expiresOn = $response->getExpiresOn();
    if ($expiresOn) {
        $domain->setExpiryDate(Carbon::parse($expiresOn->format('Y-m-d H:i:s')));
    }
    $domain->setTransferLock($response->isTransferLocked() ?? false);

    return $domain;
}

/**
 * Fetch current nameservers.
 *
 * This function should return an array of nameservers for a given domain.
 *
 */
function opusdns_GetNameservers(array $params): array
{
    return [];
}

/**
 * Save nameserver changes.
 *
 * This function should submit a change of nameservers request to the
 * domain registrar.
 *
 */
function opusdns_SaveNameservers(array $params): array
{
    $domainName = $params['domain'];
    $nameservers = NameserverHelper::extractFromParams($params);

    if (empty($nameservers)) {
        return ['error' => 'No nameservers provided for update.'];
    }

    try {
        $api = opusdns_initApiClient($params);
        $api->domains()->update($domainName, ['nameservers' => $nameservers]);
        return ['success' => true];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

function opusdns_GetContactDetails(array $params): array
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

function opusdns_SaveContactDetails(array $params): array
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
function opusdns_CheckAvailability(array $params): ResultsList | array
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
            $status = match ($item->isAvailable()) {
                true => SearchResult::STATUS_NOT_REGISTERED,
                false => SearchResult::STATUS_REGISTERED,
            };
            $searchResult->setStatus($status);
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
function opusdns_DomainSuggestionOptions(): array
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
function opusdns_GetDomainSuggestions(array $params): ResultsList | array
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
            $status = match ($item->isAvailable()) {
                true => SearchResult::STATUS_NOT_REGISTERED,
                false => SearchResult::STATUS_REGISTERED,
            };
            $searchResult->setStatus($status);
            $results->append($searchResult);
        }

        return $results;
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

function opusdns_GetRegistrarLock(array $params): string
{
    return '';
}

/**
 * Set registrar lock status.
 *
 * Also known as Domain Lock or Transfer Lock status.
 */
function opusdns_SaveRegistrarLock(array $params): array
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
function opusdns_GetEPPCode(array $params): array
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
function opusdns_RequestDelete(array $params): array
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
function opusdns_Sync(array $params): array
{
    $domainName = $params['domain'];
    try {
        $api = opusdns_initApiClient($params);
        $response = $api->domains()->getByName($domainName)->getData();
        $expiresOn = $response->getExpiresOn();

        if (!$expiresOn) {
            return ['error' => 'Domain has no expiry date (may be pending transfer)'];
        }

        return [
            'expirydate' => $expiresOn->format('Y-m-d'),
        ];
    } catch (ApiException $e) {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Incoming Domain Transfer Sync.
 *
 * Check status of incoming domain transfers and notify end-user upon
 * completion. This function is called daily for incoming domains.
 *
 */
function opusdns_TransferSync(array $params): array
{
    $domainName = $params['domain'];
    try {
        $api = opusdns_initApiClient($params);
        $response = $api->domains()->getByName($domainName)->getData();
        $registryStatuses = $response->getRegistryStatuses() ?? [];

        if (in_array('pendingTransfer', $registryStatuses)) {
            return [];
        }

        $expiresOn = $response->getExpiresOn();
        if ($expiresOn) {
            return [
                'completed' => true,
                'expirydate' => $expiresOn->format('Y-m-d'),
            ];
        }

        return [
            'completed' => true,
        ];
    } catch (ApiException $e) {
        if ($e->getStatusCode() === 404) {
            return [
                'failed' => true,
                'reason' => 'Domain not found or transfer failed or was rejected',
            ];
        }
        return ['error' => $e->getMessage()];
    }
}

function opusdns_GetTldPricing(array $params): ResultsList | array
{
    try {
        $api = opusdns_initApiClient($params);
        $tldGroups = $api->tlds()->getTlds();
        $prices = $api->pricing()->getPrices($params['ClientID'], ProductType::DOMAIN);

        $results = new ResultsList();

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

function opusdns_ClientAreaCustomButtonArray(array $params): array
{
    $lang = opusdns_loadLanguage();
    $dns_zone_label = $lang['opusdns']['dns_zone']['menu_label'] ?? 'Manage DNS Zone';
    return [
        $dns_zone_label => 'dns_zone',
    ];
}

function opusdns_ClientAreaAllowedFunctions(array $params): array
{
    $lang = opusdns_loadLanguage();
    $dns_zone_label = $lang['opusdns']['dns_zone']['menu_label'] ?? 'Manage DNS Zone';

    return [
        $dns_zone_label => 'dns_zone',
        'dns_zone_get' => 'dns_zone_get',
        'dns_zone_create' => 'dns_zone_create',
        'dns_zone_delete' => 'dns_zone_delete',
        'dns_zone_add_rrset' => 'dns_zone_add_rrset',
        'dns_zone_update_rrset' => 'dns_zone_update_rrset',
        'dns_zone_delete_rrset' => 'dns_zone_delete_rrset',
        'dns_zone_delete_rrsets' => 'dns_zone_delete_rrsets',
        'dns_zone_set_nameservers' => 'dns_zone_set_nameservers',
        'dns_zone_dnssec_enable' => 'dns_zone_dnssec_enable',
        'dns_zone_dnssec_disable' => 'dns_zone_dnssec_disable',
        'dns_zone_template_list' => 'dns_zone_template_list',
        'dns_zone_template_get' => 'dns_zone_template_get',
        'dns_zone_upsert_rrsets' => 'dns_zone_upsert_rrsets',
    ];
}


function opusdns_dns_zone(array $params): array
{
    $lang = opusdns_loadLanguage();
    $domainId = $params['domainid'];
    $token = trim($_REQUEST['token'] ?? '');
    $currentpagelinkback = 'clientarea.php?action=domaindetails&id=' . $domainId . '&modop=custom&a=dns_zone&token=' . $token . '&';

    return [
        'templatefile' => 'dns_zone',
        'vars' => [
            'domain' => $params['domain'],
            'domainid' => $params['domainid'],
            'currentpagelinkback' => $currentpagelinkback,
            'LANG' => $lang,
        ],
    ];
}

function opusdns_dns_zone_get(array $params): array
{
    header('Content-Type: application/json');
    $domainName = $params['domain'];

    try {
        $api = opusdns_initApiClient($params);
        $zone = $api->dns()->getZone($domainName)->getData();
        $rrsets = $zone->getUserEditableRecords($domainName);

        $domainInfo = opusdns_GetDomainInformation($params);
        if (is_array($domainInfo) && isset($domainInfo['error'])) {
            echo json_encode($domainInfo);
            exit;
        }

        $domainNameservers = array_map('strtolower', array_values($domainInfo->getNameservers()));
        $zoneNameservers = array_map('strtolower', $zone->getZoneNsRecords());

        $sortedDomainNs = $domainNameservers;
        $sortedZoneNs = $zoneNameservers;
        sort($sortedDomainNs);
        sort($sortedZoneNs);

        $delegated = !empty($sortedZoneNs) && $sortedDomainNs === $sortedZoneNs;

        $result = [
            'success' => true,
            'zone' => [
                'name' => $zone->getName(),
                'soa' => $zone->getZoneSoaRecord(),
                'nameservers' => $zoneNameservers,
                'dnssec' => [
                    'enabled' => $zone->getDnssecStatus() === 'enabled',
                    'ds_records' => $zone->getZoneDsRecords(),
                    'dnskey_records' => $zone->getZoneDnskeyRecords(),
                ],
                'created_on' => $zone->getCreatedOn() ? $zone->getCreatedOn()->format('Y-m-d H:i:s') : null,
                'updated_on' => $zone->getUpdatedOn() ? $zone->getUpdatedOn()->format('Y-m-d H:i:s') : null,
            ],
            'domain' => [
                'name' => $domainInfo->getDomain(),
                'nameservers' => $domainNameservers,
                'delegated' => $delegated,
            ],
            'rrsets' => $rrsets,
        ];

        echo json_encode($result);
        exit;
    } catch (ApiException $e) {
        if ($e->getStatusCode() === 404) {
            echo json_encode(['error' => 'Zone not found', 'not_found' => true]);
            exit;
        }
        echo json_encode(['error' => 'Failed to load DNS records']);
        exit;
    }
}

function opusdns_api_json_wrapper(array $params, callable $handler): array
{
    header('Content-Type: application/json');

    try {
        $api = opusdns_initApiClient($params);
        $result = $handler($api, $params);
        echo json_encode($result);
        exit;
    } catch (ApiException $e) {
        $errors = $e->getErrors();
        $errorMessage = is_array($errors) ? ErrorHelper::extractRrsetErrors($errors) : $e->getMessage();

        $response = ['error' => $errorMessage ?: 'Operation failed'];

        if ($e->getStatusCode() === 404) {
            $response['not_found'] = true;
        }

        echo json_encode($response);
        exit;
    }
}

function opusdns_dns_zone_add_rrset(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $api->dns()->addRrsetFromFormData($params['domain'], $_POST);
        return ['success' => true];
    });
}

function opusdns_dns_zone_update_rrset(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $api->dns()->updateRrsetFromFormData($params['domain'], $_POST);
        return ['success' => true];
    });
}

function opusdns_dns_zone_upsert_rrsets(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $rrsetsRaw = html_entity_decode($_POST['rrsets'] ?? '[]');
        $rrsets = json_decode($rrsetsRaw, true);

        if (empty($rrsets) || !is_array($rrsets)) {
            throw new ApiException('No records provided');
        }

        $api->dns()->upsertRrsets($params['domain'], $rrsets);

        return ['success' => true];
    });
}

function opusdns_dns_zone_delete_rrset(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $api->dns()->deleteRrsetFromFormData($params['domain'], $_POST);
        return ['success' => true];
    });
}

function opusdns_dns_zone_delete_rrsets(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $rrsetsRaw = html_entity_decode($_POST['rrsets'] ?? '[]');
        $rrsets = json_decode($rrsetsRaw, true);

        if (empty($rrsets) || !is_array($rrsets)) {
            throw new ApiException('No records provided');
        }

        $api->dns()->deleteRrsets($params['domain'], $rrsets);

        return ['success' => true];
    });
}

function opusdns_dns_zone_set_nameservers(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $rawNameservers = html_entity_decode($_POST['nameservers'] ?? '[]');
        $nameservers = json_decode($rawNameservers, true);

        if (empty($nameservers)) {
            throw new ApiException('No nameservers provided');
        }

        $nameserverData = NameserverHelper::buildApiFormat($nameservers);
        $api->domains()->update($params['domain'], ['nameservers' => $nameserverData]);

        return ['success' => true];
    });
}

function opusdns_dns_zone_create(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $api->dns()->createZone($params['domain']);
        return ['success' => true];
    });
}

function opusdns_dns_zone_delete(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $api->dns()->deleteZone($params['domain']);
        return ['success' => true];
    });
}

function opusdns_dns_zone_dnssec_enable(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $api->dns()->enableDnssec($params['domain']);
        return ['success' => true];
    });
}

function opusdns_dns_zone_dnssec_disable(array $params): array
{
    return opusdns_api_json_wrapper($params, function ($api, $params) {
        $api->dns()->disableDnssec($params['domain']);
        return ['success' => true];
    });
}

function opusdns_dns_zone_template_list(array $params): array
{
    header('Content-Type: application/json');

    try {
        $templates = \WHMCS\Module\Registrar\OpusDNS\Service\DnsTemplates::listTemplates();

        echo json_encode([
            'success' => true,
            'templates' => array_values($templates),
        ]);
        exit;
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => 'Failed to load templates: ' . $e->getMessage(),
        ]);
        exit;
    }
}
