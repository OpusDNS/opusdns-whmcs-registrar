<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Models\Host;
use WHMCS\Module\Registrar\OpusDNS\Service\BaseService;

class Hosts extends BaseService
{
    protected const MODEL_CLASS = Host::class;
    public function create(array $attributes): ApiResponse
    {
        return $this->postResource('/hosts', $attributes);
    }

    public function getByHostname(string $hostReference): ApiResponse
    {
        return $this->getResource("/hosts/{$hostReference}");
    }

    public function update(string $hostReference, array $attributes): ApiResponse
    {
        return $this->putResource("/hosts/{$hostReference}", $attributes);
    }

    public function delete(string $hostReference): void
    {
        $this->deleteResource("/hosts/{$hostReference}");
    }
}
