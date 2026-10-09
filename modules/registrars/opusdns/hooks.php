<?php

declare(strict_types=1);

if (!defined('WHMCS')) {
    die('This file cannot be accessed directly');
}

require_once __DIR__ . '/vendor/autoload.php';

use WHMCS\Module\Registrar\OpusDNS\Hooks\DomainEventHooks;
use WHMCS\Module\Registrar\OpusDNS\Hooks\RegistrarLockHooks;

add_hook('ClientAreaPrimarySidebar', 1, [RegistrarLockHooks::class, 'hideSidebarItem']);
add_hook('ClientAreaPageDomainDetails', 1, [RegistrarLockHooks::class, 'hideOnDomainDetails']);
add_hook('AfterCronJob', 1, [DomainEventHooks::class, 'processEvents']);
