<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

use OpusDNS\Client\Enum\BillingTransactionAction;
use OpusDNS\Client\Model\CommonModelsDomainDomainDomainAvailabilityResponse as DomainCheckResult;
use OpusDNS\Client\Model\PremiumPricingAction;

class PremiumPricingHelper
{
    /**
     * The premium prices of a checked domain in the layout SearchResult::setPremiumCostPricing() expects, or
     * null when the registry did not return both the create and the renew price.
     *
     * @return array{register: string, renew: string, CurrencyCode: string}|null
     */
    public static function whmcsPricing(DomainCheckResult $result): ?array
    {
        $prices = $result->premiumPricing === null ? [] : $result->premiumPricing->prices;
        $registerPrice = self::priceForAction($prices, BillingTransactionAction::CREATE->value);
        $renewPrice = self::priceForAction($prices, BillingTransactionAction::RENEW->value);
        $currency = $prices === [] ? null : $prices[0]->currency;

        if ($registerPrice === null || $renewPrice === null || $currency === null) {
            return null;
        }

        return [
            'register' => $registerPrice,
            'renew' => $renewPrice,
            'CurrencyCode' => $currency,
        ];
    }

    /**
     * The premium price WHMCS quoted, formatted for the expected_price field, or null when the order is not
     * for a premium domain.
     *
     * @param array<string, mixed> $params
     */
    public static function expectedPrice(array $params): ?string
    {
        $premiumEnabled = (bool) ($params['premiumEnabled'] ?? false);
        $premiumCost = $params['premiumCost'] ?? null;

        if (!$premiumEnabled || !$premiumCost) {
            return null;
        }

        return number_format((float) $premiumCost, 2, '.', '');
    }

    /**
     * @param list<PremiumPricingAction> $prices
     */
    private static function priceForAction(array $prices, string $action): ?string
    {
        foreach ($prices as $price) {
            if ($price->action === $action) {
                return $price->price;
            }
        }

        return null;
    }
}
