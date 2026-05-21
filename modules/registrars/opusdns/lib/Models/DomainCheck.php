<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class DomainCheck
{
    use ModelTrait;

    private bool $available = false;

    private string $claims_key = '';

    private string $domain = '';

    private bool $is_premium = false;

    private array $premium_pricing = [];

    private string $reason = '';

    public function __construct(array $data = [])
    {
        $this->available = isset($data['available']) ? (bool)$data['available'] : false;
        $this->claims_key = isset($data['claims_key']) ? (string)$data['claims_key'] : '';
        $this->domain = isset($data['domain']) ? (string)$data['domain'] : '';
        $this->is_premium = isset($data['is_premium']) ? (bool)$data['is_premium'] : false;
        $this->premium_pricing = isset($data['premium_pricing']) && is_array($data['premium_pricing'])
            ? $data['premium_pricing']
            : [];
        $this->reason = isset($data['reason']) ? (string)$data['reason'] : '';
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getClaimsKey(): string
    {
        return $this->claims_key;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function isPremium(): bool
    {
        return $this->is_premium;
    }

    public function getPremiumPricing(): array
    {
        return $this->premium_pricing;
    }

    public function getPremiumPriceByAction(string $action): ?array
    {
        $prices = $this->premium_pricing['prices'] ?? [];
        foreach ($prices as $price) {
            if (($price['action'] ?? '') === $action) {
                return $price;
            }
        }
        return null;
    }

    public function getPremiumRegisterPrice(): ?string
    {
        return $this->getPremiumPriceByAction('create')['price'] ?? null;
    }

    public function getPremiumRenewPrice(): ?string
    {
        return $this->getPremiumPriceByAction('renew')['price'] ?? null;
    }

    public function getPremiumCurrency(): ?string
    {
        $prices = $this->premium_pricing['prices'] ?? [];
        return !empty($prices) ? ($prices[0]['currency'] ?? null) : null;
    }

    public function getReason(): string
    {
        return $this->reason;
    }
}
