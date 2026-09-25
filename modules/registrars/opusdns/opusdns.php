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

require_once __DIR__ . '/vendor/autoload.php';

use OpusDNS\Client\Client;
use OpusDNS\Client\Enum\BillingTransactionAction;
use OpusDNS\Client\Enum\BillingTransactionProductType;
use OpusDNS\Client\Enum\DnssecRecordType;
use OpusDNS\Client\Enum\DnssecStatus;
use OpusDNS\Client\Enum\DomainClientStatus;
use OpusDNS\Client\Enum\PeriodUnit;
use OpusDNS\Client\Enum\RegistrantChangeType;
use OpusDNS\Client\Enum\RenewalMode;
use OpusDNS\Client\Exception\NotFoundException;
use OpusDNS\Client\Exception\OpusDnsException;
use OpusDNS\Client\Model\DomainCreate;
use OpusDNS\Client\Model\DomainPeriod;
use OpusDNS\Client\Model\DomainRenewRequest;
use OpusDNS\Client\Model\DomainTransferIn;
use OpusDNS\Client\Model\DomainUpdate;
use OpusDNS\Client\Model\DnsZoneCreate;
use OpusDNS\Client\Model\HostCreate;
use OpusDNS\Client\Model\HostUpdate;
use WHMCS\Domains\DomainLookup\ResultsList;
use WHMCS\Domains\DomainLookup\SearchResult;
use WHMCS\Carbon;
use WHMCS\Domain\Registrar\Domain;
use WHMCS\Module\Registrar\OpusDNS\ApiClientFactory;
use WHMCS\Module\Registrar\OpusDNS\Helper\AttributeHelper;
use WHMCS\Module\Registrar\OpusDNS\Helper\ContactHelper;
use WHMCS\Module\Registrar\OpusDNS\Helper\DnsZoneHelper;
use WHMCS\Module\Registrar\OpusDNS\Helper\ErrorHelper;
use WHMCS\Module\Registrar\OpusDNS\Helper\NameserverHelper;
use WHMCS\Module\Registrar\OpusDNS\Helper\PremiumPricingHelper;
use WHMCS\Module\Registrar\OpusDNS\Service\Dns;
use WHMCS\Module\Registrar\OpusDNS\Service\Dnssec;
use WHMCS\Module\Registrar\OpusDNS\Service\DnsTemplates;
use WHMCS\Module\Registrar\OpusDNS\Service\Tlds;
use WHMCS\Exception\Module\InvalidConfiguration;

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
        'ApiKey' => [
            'FriendlyName' => 'API Key',
            'Type' => 'password',
            'Size' => '50',
            'Default' => '',
            'Description' => 'Your OpusDNS API key.',
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
function opusdns_initApiClient(array $params): Client
{
    return ApiClientFactory::fromParams($params);
}

function opusdns_config_validate(array $params): void
{
    try {
        $api = opusdns_initApiClient($params);
        $api->tld()->getTldSpecifications(fields: 'enabled');
    } catch (\Throwable $exception) {
        throw new InvalidConfiguration(ErrorHelper::message($exception));
    }
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

    $missingAttribute = AttributeHelper::validateRequired($tld, $params);
    if ($missingAttribute !== null) {
        return ['error' => $missingAttribute];
    }

    try {
        $api = opusdns_initApiClient($params);
        $tldInfo = (new Tlds($api))->getTld($tld);

        if (!$tldInfo) {
            return ['error' => "TLD .{$tld} is not supported"];
        }
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }

    try {
        $createdContact = $api->contact()->createContact(ContactHelper::createFromParams($params));
        $contactId = $createdContact->contactId;

        if ($contactId === null) {
            return ['error' => 'The registrant contact was created without an id'];
        }
    } catch (OpusDnsException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }

    $attributes = AttributeHelper::extractFromParams($tld, $params);

    $domainRequest = new DomainCreate(
        contacts: $tldInfo->buildContacts($contactId),
        name: $domainName,
        period: new DomainPeriod(PeriodUnit::Y, (int)$params['regperiod']),
        renewalMode: RenewalMode::EXPIRE,
        attributes: $attributes ?: null,
        expectedPrice: PremiumPricingHelper::expectedPrice($params),
        nameservers: NameserverHelper::extractFromParams($params),
    );

    try {
        $api->domain()->createDomain($domainRequest);
        return ['success' => true];
    } catch (OpusDnsException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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

    $missingAttribute = AttributeHelper::validateRequired($tld, $params);
    if ($missingAttribute !== null) {
        return ['error' => $missingAttribute];
    }

    try {
        $api = opusdns_initApiClient($params);
        $tldInfo = (new Tlds($api))->getTld($tld);

        if (!$tldInfo) {
            return ['error' => "TLD .{$tld} is not supported"];
        }
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }

    try {
        $createdContact = $api->contact()->createContact(ContactHelper::createFromParams($params));
        $contactId = $createdContact->contactId;

        if ($contactId === null) {
            return ['error' => 'The registrant contact was created without an id'];
        }
    } catch (OpusDnsException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }

    $attributes = AttributeHelper::extractFromParams($tld, $params);

    $transferRequest = new DomainTransferIn(
        name: $domainName,
        renewalMode: RenewalMode::EXPIRE,
        attributes: $attributes ?: null,
        authCode: $authCode,
        contacts: $tldInfo->buildContacts($contactId),
        expectedPrice: PremiumPricingHelper::expectedPrice($params),
        nameservers: NameserverHelper::extractFromParams($params),
    );

    try {
        $api->domain()->transferDomain($transferRequest);
        return ['success' => true];
    } catch (OpusDnsException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
        $tldInfo = (new Tlds($api))->getTld($tld);

        if (!$tldInfo) {
            return ['error' => "TLD .{$tld} is not supported"];
        }

        $domainInfo = $api->domain()->getDomain($domainName);
        $registryExpiryDate = $domainInfo->expiresOn;

        if (!$registryExpiryDate) {
            return ['error' => 'Domain has no registry expiry date (may be pending transfer)'];
        }

        $whmcsDate = $whmcsExpiryDate->format('Y-m-d');
        $registryDate = $registryExpiryDate->format('Y-m-d');

        if ($whmcsDate !== $registryDate) {
            return ['error' => "Date mismatch: WHMCS has {$whmcsDate}, Registry has {$registryDate}. Please sync the domain first."];
        }

        $renewRequest = new DomainRenewRequest(
            currentExpiryDate: $registryExpiryDate,
            period: new DomainPeriod(PeriodUnit::Y, $renewPeriod),
            expectedPrice: PremiumPricingHelper::expectedPrice($params),
        );

        $api->domain()->renewDomain($domainName, $renewRequest);

        return ['success' => true];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }
}


function opusdns_GetDomainInformation(array $params): Domain | array
{
    $domainName = $params['domain'];

    try {
        $api = opusdns_initApiClient($params);
        $response = $api->domain()->getDomain($domainName);
        $tldInfo = (new Tlds($api))->getTld($params['tld']);
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return [
            'error' => ErrorHelper::message($exception),
        ];
    }

    $domain = new Domain();
    $domain->setIsIrtpEnabled(false);
    $domain->setDomain($response->name);
    $domain->setNameservers(NameserverHelper::toWhmcsArray($response->nameservers));
    $expiresOn = $response->expiresOn;
    if ($expiresOn) {
        $domain->setExpiryDate(Carbon::parse($expiresOn->format('Y-m-d H:i:s')));
    }

    if ($tldInfo && $tldInfo->supportsTransferLock()) {
        $domain->setTransferLock($response->transferLock);
    }

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
        $api->domain()->updateDomain($domainName, new DomainUpdate(nameservers: $nameservers));
        return ['success' => true];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }
}

function opusdns_GetContactDetails(array $params): array
{
    try {
        $api = opusdns_initApiClient($params);
        $domain = $api->domain()->getDomain($params['domain']);
        $registrantContactId = ContactHelper::registrantContactId($domain);

        if (!$registrantContactId) {
            return ['error' => 'Registrant contact not found'];
        }

        $registrant = $api->contact()->getContact($registrantContactId);

        return ['Registrant' => ContactHelper::toWhmcsArray($registrant)];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
        $tldInfo = (new Tlds($api))->getTld($tld);

        if (!$tldInfo) {
            return ['error' => "TLD .{$tld} is not supported"];
        }

        $tldContacts = $tldInfo->getContacts();
        $registrantChange = $tldContacts['registrant_change'] ?? null;

        if ($registrantChange !== RegistrantChangeType::UPDATE->value) {
            return ['error' => 'Contact updates are not supported for this TLD'];
        }

        $domain = $api->domain()->getDomain($params['domain']);
        $registrantContactId = ContactHelper::registrantContactId($domain);

        if (!$registrantContactId) {
            return ['error' => 'Registrant contact not found'];
        }

        $currentData = ContactHelper::toWhmcsArray($api->contact()->getContact($registrantContactId));
        $filteredSubmittedData = array_intersect_key($submittedData, $currentData);

        if (isset($filteredSubmittedData['Phone Number'])) {
            $filteredSubmittedData['Phone Number'] = ContactHelper::normalizePhone($filteredSubmittedData['Phone Number']);
        }

        $differences = array_diff_assoc($filteredSubmittedData, $currentData);

        if (empty($differences)) {
            return ['success' => true];
        }

        $newContact = $api->contact()->createContact(ContactHelper::createFromWhmcsDetails($submittedData));
        $newContactId = $newContact->contactId;

        if ($newContactId === null) {
            return ['error' => 'The registrant contact was created without an id'];
        }

        $api->domain()->updateDomain($params['domain'], new DomainUpdate(contacts: $tldInfo->buildContacts($newContactId)));

        return ['success' => true];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
    $isPremiumEnabled = (bool)($params['premiumEnabled'] ?? false);

    try {
        $api = opusdns_initApiClient($params);
        $results = new ResultsList();
        $apiAvailabilityResults = $api->domain()->eppCheckDomain($domainsToCheck)->results;

        foreach ($apiAvailabilityResults as $item) {
            $domainObj = new \WHMCS\Domains\Domain($item->domain);
            $searchResult = SearchResult::factoryFromDomain($domainObj);

            $searchResult->setStatus(
                $item->available
                    ? SearchResult::STATUS_NOT_REGISTERED
                    : SearchResult::STATUS_REGISTERED
            );

            $premiumPricing = PremiumPricingHelper::whmcsPricing($item);

            if ($item->available && $item->isPremium && $isPremiumEnabled && $premiumPricing !== null) {
                $searchResult->setPremiumDomain(true);
                $searchResult->setPremiumCostPricing($premiumPricing);
            } elseif ($item->isPremium) {
                $searchResult->setStatus(SearchResult::STATUS_REGISTERED);
            }

            $results->append($searchResult);
        }

        return $results;
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
    $includePremium = (bool)($params['premiumEnabled'] ?? false);

    try {
        $api = opusdns_initApiClient($params);
        $results = new ResultsList();

        $apiSuggestionResults = $api->domainSearch()->suggest(
            $searchTerm,
            tlds: $tldsToInclude,
            limit: $limit,
            premium: $includePremium,
        )->results;

        $premiumDomains = [];
        foreach ($apiSuggestionResults as $item) {
            if ($item->premium) {
                $premiumDomains[] = $item->domain;
            }
        }

        $checkMap = [];
        if (!empty($premiumDomains)) {
            $checkResults = $api->domain()->eppCheckDomain($premiumDomains)->results;
            foreach ($checkResults as $checkItem) {
                $checkMap[$checkItem->domain] = $checkItem;
            }
        }

        foreach ($apiSuggestionResults as $item) {
            $domainObj = new \WHMCS\Domains\Domain($item->domain);
            $searchResult = SearchResult::factoryFromDomain($domainObj);
            $status = $item->available
                ? SearchResult::STATUS_NOT_REGISTERED
                : SearchResult::STATUS_REGISTERED;
            $searchResult->setStatus($status);

            if ($item->available && $item->premium && $includePremium) {
                $checkItem = $checkMap[$item->domain] ?? null;
                $premiumPricing = $checkItem !== null ? PremiumPricingHelper::whmcsPricing($checkItem) : null;

                if ($premiumPricing !== null) {
                    $searchResult->setPremiumDomain(true);
                    $searchResult->setPremiumCostPricing($premiumPricing);
                } else {
                    $searchResult->setStatus(SearchResult::STATUS_REGISTERED);
                }
            } elseif ($item->premium) {
                $searchResult->setStatus(SearchResult::STATUS_REGISTERED);
            }

            $results->append($searchResult);
        }
        return $results;
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }
}

/**
 * Register a Nameserver.
 *
 * Adds a child nameserver for the given domain name.
 *
 */
function opusdns_RegisterNameserver(array $params): array
{
    $tld        = $params['tld'];
    $nameserver = $params['nameserver'];
    $ipAddress  = $params['ipaddress'];

    try {
        $api     = opusdns_initApiClient($params);
        $tldInfo = (new Tlds($api))->getTld($tld);

        if (!$tldInfo || !$tldInfo->supportsHostObjects()) {
            return ['error' => "The .{$tld} registry does not support host objects"];
        }

        $api->host()->createHost(new HostCreate($nameserver, [$ipAddress]));
        return ['success' => true];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }
}

/**
 * Modify a Nameserver.
 *
 * Modifies the IP of a child nameserver.
 *
 */
function opusdns_ModifyNameserver(array $params): array
{
    $tld        = $params['tld'];
    $nameserver = $params['nameserver'];
    $newIp      = $params['newipaddress'];

    try {
        $api     = opusdns_initApiClient($params);
        $tldInfo = (new Tlds($api))->getTld($tld);

        if (!$tldInfo || !$tldInfo->supportsHostObjects()) {
            return ['error' => "The .{$tld} registry does not support host objects"];
        }

        $api->host()->updateHost($nameserver, new HostUpdate([$newIp]));
        return ['success' => true];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }
}

/**
 * Delete a Nameserver.
 *
 * Deletes a child nameserver for the given domain name.
 *
 */
function opusdns_DeleteNameserver(array $params): array
{
    $tld        = $params['tld'];
    $nameserver = $params['nameserver'];

    try {
        $api     = opusdns_initApiClient($params);
        $tldInfo = (new Tlds($api))->getTld($tld);

        if (!$tldInfo || !$tldInfo->supportsHostObjects()) {
            return ['error' => "The .{$tld} registry does not support host objects"];
        }

        $api->host()->deleteHost($nameserver);
        return ['success' => true];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
    $tld = $params['tld'];
    $isLocked = $params['lockenabled'] === 'locked';

    try {
        $api = opusdns_initApiClient($params);
        $tldInfo = (new Tlds($api))->getTld($tld);

        if (!$tldInfo || !$tldInfo->supportsTransferLock()) {
            return ['error' => "The .{$tld} registry does not support registrar lock"];
        }

        $statuses = $isLocked ? [DomainClientStatus::CLIENT_TRANSFER_PROHIBITED] : [];
        $api->domain()->updateDomain($domainName, new DomainUpdate(statuses: $statuses));
        return ['success' => true];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
        $response = $api->domain()->getDomain($domainName);
        return ['eppcode' => $response->authCode];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
        $api->domain()->deleteDomain($domainName);
        return ['success' => true];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
        $response = $api->domain()->getDomain($domainName);
        $expiresOn = $response->expiresOn;

        if (!$expiresOn) {
            return ['error' => 'Domain has no expiry date (may be pending transfer)'];
        }

        return [
            'expirydate' => $expiresOn->format('Y-m-d'),
        ];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
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
        $response = $api->domain()->getDomain($domainName);
        $registryStatuses = $response->registryStatuses ?? [];

        if (in_array('pendingTransfer', $registryStatuses)) {
            return [];
        }

        $expiresOn = $response->expiresOn;
        if ($expiresOn) {
            return [
                'completed' => true,
                'expirydate' => $expiresOn->format('Y-m-d'),
            ];
        }

        return [
            'completed' => true,
        ];
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        if ($exception instanceof NotFoundException) {
            return [
                'failed' => true,
                'reason' => 'Domain not found or transfer failed or was rejected',
            ];
        }
        return ['error' => ErrorHelper::message($exception)];
    }
}

function opusdns_GetTldPricing(array $params): ResultsList | array
{
    try {
        $api = opusdns_initApiClient($params);
        $tldGroups = (new Tlds($api))->getTlds();
        $organizationId = $api->authentication()->introspectClientCredential()->organizationId;

        if ($organizationId === null) {
            return ['error' => 'The API key is not linked to an organization'];
        }

        $prices = $api->organization()->getPricingPlans($organizationId, BillingTransactionProductType::DOMAIN)->prices;

        $results = new ResultsList();

        $pricesByTld = [];
        foreach ($prices as $price) {
            $productClass = $price->productClass;
            $productAction = $price->productAction;
            $period = $price->period;

            if (!$productClass || !$productAction) {
                continue;
            }

            if ($period === null || $period->value !== 1 || $period->unit !== PeriodUnit::Y) {
                continue;
            }

            if (!isset($pricesByTld[$productClass])) {
                $pricesByTld[$productClass] = [
                    'currency' => $price->currency,
                ];
            }

            $pricesByTld[$productClass][$productAction] = (float)$price->price;
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
                $registerPrice = ($tldPricing[BillingTransactionAction::CREATE->value] ?? 0) * $minYears;
                $renewPrice = isset($tldPricing[BillingTransactionAction::RENEW->value]) ? $tldPricing[BillingTransactionAction::RENEW->value] * $minYears : null;
                $transferPrice = isset($tldPricing[BillingTransactionAction::TRANSFER->value]) ? $tldPricing[BillingTransactionAction::TRANSFER->value] * $minYears : null;
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
                    ->setRedemptionFeePrice($tldPricing[BillingTransactionAction::RESTORE->value] ?? null)
                    ->setCurrency($tldPricing['currency'])
                    ->setEppRequired($eppRequired);

                $results[] = $item;
            }
        }
        return $results;
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        return ['error' => ErrorHelper::message($exception)];
    }
}

function opusdns_ClientAreaCustomButtonArray(array $params): array
{
    $lang = opusdns_loadLanguage();
    $dns_zone_label = $lang['opusdns']['dns_zone']['menu_label'] ?? 'Manage DNS Zone';
    $buttons = [];

    try {
        $tldInfo = (new Tlds(opusdns_initApiClient($params)))->getTld($params['tld']);
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        $tldInfo = null;
    }

    if ($tldInfo && $tldInfo->supportsDnssec()) {
        $buttons[$lang['opusdns']['dnssec']['menu_label'] ?? 'DNSSEC Management'] = 'dnssec';
    }

    $buttons[$dns_zone_label] = 'dns_zone';

    return $buttons;
}

function opusdns_ClientAreaAllowedFunctions(array $params): array
{
    $lang = opusdns_loadLanguage();
    $dns_zone_label = $lang['opusdns']['dns_zone']['menu_label'] ?? 'Manage DNS Zone';
    $dnssecLabel = $lang['opusdns']['dnssec']['menu_label'] ?? 'DNSSEC Management';

    return [
        $dns_zone_label => 'dns_zone',
        $dnssecLabel => 'dnssec',
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
        $zone = $api->dns()->getZone($domainName);
        $rrsets = DnsZoneHelper::userEditableRecords($zone);

        $domainInfo = opusdns_GetDomainInformation($params);
        if (is_array($domainInfo) && isset($domainInfo['error'])) {
            echo json_encode($domainInfo);
            exit;
        }

        $domainNameservers = array_map('strtolower', array_values($domainInfo->getNameservers()));
        $zoneNameservers = array_map('strtolower', DnsZoneHelper::nameservers($zone));

        $sortedDomainNs = $domainNameservers;
        $sortedZoneNs = $zoneNameservers;
        sort($sortedDomainNs);
        sort($sortedZoneNs);

        $delegated = !empty($sortedZoneNs) && $sortedDomainNs === $sortedZoneNs;

        $result = [
            'success' => true,
            'zone' => [
                'name' => $zone->name,
                'soa' => DnsZoneHelper::soaRecord($zone),
                'nameservers' => $zoneNameservers,
                'dnssec' => [
                    'enabled' => $zone->dnssecStatus === DnssecStatus::ENABLED,
                    'ds_records' => DnsZoneHelper::dsRecords($zone),
                    'dnskey_records' => DnsZoneHelper::dnskeyRecords($zone),
                ],
                'created_on' => $zone->createdOn ? $zone->createdOn->format('Y-m-d H:i:s') : null,
                'updated_on' => $zone->updatedOn ? $zone->updatedOn->format('Y-m-d H:i:s') : null,
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
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        if ($exception instanceof NotFoundException) {
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
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        $response = ['error' => ErrorHelper::message($exception) ?: 'Operation failed'];

        if ($exception instanceof NotFoundException) {
            $response['not_found'] = true;
        }

        echo json_encode($response);
        exit;
    }
}

function opusdns_dns_zone_add_rrset(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        (new Dns($api))->addRecordsFromFormData($params['domain'], $_POST);
        return ['success' => true];
    });
}

function opusdns_dns_zone_update_rrset(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        (new Dns($api))->updateRrsetFromFormData($params['domain'], $_POST);
        return ['success' => true];
    });
}

function opusdns_dns_zone_upsert_rrsets(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        $rrsetsRaw = html_entity_decode($_POST['rrsets'] ?? '[]');
        $rrsets = json_decode($rrsetsRaw, true);

        if (empty($rrsets) || !is_array($rrsets)) {
            throw new \InvalidArgumentException('No records provided');
        }

        (new Dns($api))->upsertRrsets($params['domain'], $rrsets);

        return ['success' => true];
    });
}

function opusdns_dns_zone_delete_rrset(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        (new Dns($api))->deleteRrsetFromFormData($params['domain'], $_POST);
        return ['success' => true];
    });
}

function opusdns_dns_zone_delete_rrsets(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        $rrsetsRaw = html_entity_decode($_POST['rrsets'] ?? '[]');
        $rrsets = json_decode($rrsetsRaw, true);

        if (empty($rrsets) || !is_array($rrsets)) {
            throw new \InvalidArgumentException('No records provided');
        }

        (new Dns($api))->deleteRrsets($params['domain'], $rrsets);

        return ['success' => true];
    });
}

function opusdns_dns_zone_set_nameservers(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        $rawNameservers = html_entity_decode($_POST['nameservers'] ?? '[]');
        $nameservers = json_decode($rawNameservers, true);

        if (empty($nameservers) || !is_array($nameservers)) {
            throw new \InvalidArgumentException('No nameservers provided');
        }

        $nameserverData = NameserverHelper::buildApiFormat($nameservers);
        $api->domain()->updateDomain($params['domain'], new DomainUpdate(nameservers: $nameserverData));

        return ['success' => true];
    });
}

function opusdns_dns_zone_create(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        $api->dns()->createZone(new DnsZoneCreate($params['domain']));
        return ['success' => true];
    });
}

function opusdns_dns_zone_delete(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        $api->dns()->deleteZone($params['domain']);
        return ['success' => true];
    });
}

function opusdns_dns_zone_dnssec_enable(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        $api->dns()->enableDnssec($params['domain']);
        return ['success' => true];
    });
}

function opusdns_dns_zone_dnssec_disable(array $params): array
{
    return opusdns_api_json_wrapper($params, function (Client $api, array $params) {
        $api->dns()->disableDnssec($params['domain']);
        return ['success' => true];
    });
}

function opusdns_dns_zone_template_list(array $params): array
{
    header('Content-Type: application/json');

    try {
        $templates = DnsTemplates::listTemplates();

        echo json_encode([
            'success' => true,
            'templates' => array_values($templates),
        ]);
        exit;
    } catch (Exception $exception) {
        echo json_encode([
            'success' => false,
            'error' => 'Failed to load templates: ' . $exception->getMessage(),
        ]);
        exit;
    }
}

/**
 * Renders the client area DNSSEC page and handles its add and remove actions.
 */
function opusdns_dnssec(array $params): array
{
    $lang = opusdns_loadLanguage();
    $messages = $lang['opusdns']['dnssec'];
    $domainName = $params['domain'];
    $token = trim($_REQUEST['token'] ?? '');
    $pageUrl = 'clientarea.php?action=domaindetails&id=' . $params['domainid'] . '&modop=custom&a=dnssec&token=' . $token;
    $noticeSessionKey = 'opusdns_dnssec_notice_' . $params['domainid'];
    $action = $_POST['dnssec_action'] ?? null;
    $formData = (array)($_POST['dnssec'] ?? []);

    $notice = $_SESSION[$noticeSessionKey] ?? null;
    unset($_SESSION[$noticeSessionKey]);

    $supported = false;
    $recordType = DnssecRecordType::DS_DATA;
    $records = [];

    try {
        $api = opusdns_initApiClient($params);
        $dnssec = new Dnssec($api);
        $tldInfo = (new Tlds($api))->getTld($params['tld']);
        $supported = $tldInfo && $tldInfo->supportsDnssec();

        if ($supported) {
            $recordType = $tldInfo->dnssecRecordType();
            $successMessage = null;

            if ($action === 'add') {
                $invalidField = Dnssec::invalidField($formData, $recordType);

                if ($invalidField !== null) {
                    $notice = ['type' => 'danger', 'message' => sprintf($messages['errors']['invalid_field'], $messages['fields'][$invalidField])];
                } elseif (!$dnssec->addRecordFromFormData($domainName, $formData, $recordType)) {
                    $notice = ['type' => 'danger', 'message' => $messages['errors']['duplicate']];
                } else {
                    $successMessage = $messages['notices']['added'];
                }
            } elseif ($action === 'remove') {
                if ($dnssec->removeRecord($domainName, (string)($_POST['record_id'] ?? ''))) {
                    $successMessage = $messages['notices']['removed'];
                } else {
                    $notice = ['type' => 'danger', 'message' => $messages['errors']['record_not_found']];
                }
            } elseif ($action === 'remove_all') {
                $api->domain()->deleteDnssec($domainName);
                $successMessage = $messages['notices']['removed_all'];
            }

            if ($successMessage !== null) {
                $_SESSION[$noticeSessionKey] = ['type' => 'success', 'message' => $successMessage];
                header('Location: ' . $pageUrl);
                exit;
            }

            $records = $dnssec->records($domainName);
        }
    } catch (OpusDnsException | \InvalidArgumentException $exception) {
        $notice = ['type' => 'danger', 'message' => ErrorHelper::message($exception)];
    }

    return [
        'templatefile' => 'dnssec',
        'vars' => [
            'pageUrl' => $pageUrl,
            'supported' => $supported,
            'recordType' => $recordType->value,
            'records' => $records,
            'algorithmOptions' => Dnssec::algorithmOptions(),
            'digestTypeOptions' => Dnssec::digestTypeOptions(),
            'formData' => array_merge([
                'algorithm' => Dnssec::DEFAULT_ALGORITHM,
                'digest_type' => Dnssec::DEFAULT_DIGEST_TYPE,
                'flags' => Dnssec::DEFAULT_FLAGS,
                'protocol' => Dnssec::DEFAULT_PROTOCOL,
            ], $formData),
            'notice' => $notice,
            'LANG' => $lang,
        ],
    ];
}
