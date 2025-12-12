<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class DnsRdata
{
    use ModelTrait;

    private string $rdata = '';

    public function __construct(array $data = [])
    {
        $this->rdata = $data['rdata'] ?? '';
    }

    public function getRdata(): string
    {
        return $this->rdata;
    }

    public function toArray(): array
    {
        return [
            'rdata' => $this->rdata,
        ];
    }
}
