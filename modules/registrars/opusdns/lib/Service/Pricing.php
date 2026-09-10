<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Enum\ProductType;
use WHMCS\Module\Registrar\OpusDNS\Models\Price;

class Pricing extends BaseService
{
    public function getProductTypePricing(string $organizationId, ProductType $productType): ApiResponse
    {
        return $this->getResource("/organizations/{$organizationId}/pricing/product-type/{$productType->value}", [], null);
    }

    public function getPrices(string $organizationId, ProductType $productType): array
    {
        $response = $this->getProductTypePricing($organizationId, $productType);
        $data = $response->getData();

        if (!isset($data['prices']) || !is_array($data['prices'])) {
            return [];
        }

        return array_map(fn($priceData) => new Price($priceData), $data['prices']);
    }
}
