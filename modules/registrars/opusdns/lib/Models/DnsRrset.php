<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class DnsRrset
{
    use ModelTrait;

    private string $name = '';
    private string $type = '';
    private int $ttl = 3600;
    private array $records = [];

    public function __construct(array $data = [])
    {
        $this->name = $data['name'] ?? '';
        $this->type = $data['type'] ?? '';
        $this->ttl = (int)($data['ttl'] ?? 3600);

        $records = $data['records'] ?? [];
        $this->records = array_map(
            fn(array $record) => new DnsRdata($record),
            $records
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function getRecords(): array
    {
        return $this->records;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'ttl' => $this->ttl,
            'records' => array_map(fn(DnsRdata $record) => $record->toArray(), $this->records),
        ];
    }
}
