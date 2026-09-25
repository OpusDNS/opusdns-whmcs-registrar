<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Hooks;

use InvalidArgumentException;
use Menu;
use OpusDNS\Client\Exception\OpusDnsException;
use WHMCS\Domain\Domain;
use WHMCS\Domains\Domain as DomainName;
use WHMCS\Module\Registrar\OpusDNS\ApiClientFactory;
use WHMCS\Module\Registrar\OpusDNS\Service\Tlds;
use WHMCS\View\Menu\Item as MenuItem;

/**
 * Hides the registrar lock in the client area for OpusDNS domains whose TLD does not support a transfer lock.
 */
class RegistrarLockHooks
{
    public const SIDEBAR_PANEL = 'Domain Details Management';
    public const SIDEBAR_ITEM = 'Registrar Lock Status';

    /**
     * ClientAreaPrimarySidebar: removes the registrar lock item from the domain sidebar.
     */
    public static function hideSidebarItem(MenuItem $primarySidebar): void
    {
        $domain = Menu::context('domain');

        if ($domain instanceof Domain && self::isUnsupported($domain)) {
            $primarySidebar->getChild(self::SIDEBAR_PANEL)?->removeChild(self::SIDEBAR_ITEM);
        }
    }

    /**
     * ClientAreaPageDomainDetails: turns off the registrar lock tab and the unlocked warning.
     *
     * @param array<string, mixed> $vars
     * @return array<string, mixed>
     */
    public static function hideOnDomainDetails(array $vars): array
    {
        $domain = Domain::find($vars['domainid']);

        if (!$domain instanceof Domain || !self::isUnsupported($domain)) {
            return [];
        }

        return [
            'lockstatus' => '',
            'managementoptions' => ['locking' => false] + $vars['managementoptions'],
        ];
    }

    private static function isUnsupported(Domain $domain): bool
    {
        if ($domain->registrar !== ApiClientFactory::REGISTRAR) {
            return false;
        }

        try {
            $api = ApiClientFactory::fromRegistrarSettings();
            $tldInfo = $api === null ? null : (new Tlds($api))->getTld((new DomainName($domain->domain))->getTLD());
        } catch (OpusDnsException | InvalidArgumentException $exception) {
            return false;
        }

        return $tldInfo !== null && !$tldInfo->supportsTransferLock();
    }
}
