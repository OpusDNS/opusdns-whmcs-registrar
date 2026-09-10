<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Models\ClientCredentials;

class Auth extends BaseService
{
    protected const MODEL_CLASS = ClientCredentials::class;

    public function introspect(): ApiResponse
    {
        return $this->getResource('/auth/client_credentials/introspect');
    }

    public function getOrganizationId(): string
    {
        return $this->introspect()->getData()->getOrganizationId();
    }
}
