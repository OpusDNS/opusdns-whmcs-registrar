<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Hooks;

use Throwable;
use WHMCS\Module\Registrar\OpusDNS\ApiClientFactory;
use WHMCS\Module\Registrar\OpusDNS\Helper\ErrorHelper;
use WHMCS\Module\Registrar\OpusDNS\Service\DomainEvents;

class DomainEventHooks
{
    public static function processEvents(): void
    {
        try {
            if (!ApiClientFactory::isSettingEnabled('ProcessDomainEvents')) {
                return;
            }

            (new DomainEvents())->process();
        } catch (Throwable $exception) {
            logActivity('OpusDNS: processing domain events failed: ' . ErrorHelper::message($exception));
        }
    }
}
