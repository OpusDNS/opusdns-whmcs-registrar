<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Models;

use WHMCS\Module\Registrar\OpusDNS\Util\ModelTrait;

class Price
{
    use ModelTrait;

    private string $product_type = '';
    private string $product_action = '';
    private string $product_class = '';
    private float $price = 0.0;
    private string $currency = '';
    private array $period = [];

    public function __construct(array $data = [])
    {
        $this->product_type = isset($data['product_type']) ? (string)$data['product_type'] : '';
        $this->product_action = isset($data['product_action']) ? (string)$data['product_action'] : '';
        $this->product_class = isset($data['product_class']) ? (string)$data['product_class'] : '';
        $this->price = isset($data['price']) ? (float)$data['price'] : 0.0;
        $this->currency = isset($data['currency']) ? (string)$data['currency'] : '';
        $this->period = isset($data['period']) && is_array($data['period']) ? $data['period'] : [];
    }

    public function getProductType(): string
    {
        return $this->product_type;
    }

    public function getProductAction(): string
    {
        return $this->product_action;
    }

    public function getProductClass(): string
    {
        return $this->product_class;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getPeriod(): array
    {
        return $this->period;
    }
}
