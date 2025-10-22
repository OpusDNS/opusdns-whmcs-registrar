<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Enum;

enum GrantType: string
{
    case CLIENT_CREDENTIALS = 'client_credentials';
    case PASSWORD = 'password';
    case REFRESH_TOKEN = 'refresh_token';
}
