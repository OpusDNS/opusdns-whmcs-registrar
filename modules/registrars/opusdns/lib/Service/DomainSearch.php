<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use WHMCS\Module\Registrar\OpusDNS\ApiResponse;
use WHMCS\Module\Registrar\OpusDNS\Models\DomainSearchSuggestion;

class DomainSearch extends BaseService
{
    protected const MODEL_CLASS = DomainSearchSuggestion::class;

    public function suggest(string $query, array $options = []): ApiResponse
    {
        if (empty(trim($query))) {
            throw new \InvalidArgumentException('Search query cannot be empty');
        }

        $params = array_merge(['query' => $query], $options);

        if (isset($options['limit']) && (!is_int($options['limit']) || $options['limit'] < 1)) {
            throw new \InvalidArgumentException('Limit parameter must be a positive integer');
        }

        return $this->getResource('/domain-search/suggest', $params);
    }
}
