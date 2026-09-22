<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;
use OpusDNS\Client\Union;

final readonly class ContextListResponse implements ApiModel
{
    /**
     * @param list<ZonesContext|ContactsContext|DomainsContext|DomainForwardsContext|EmailForwardsContext|DomainRecommendationsContext|AggregationsContext> $results
     */
    public function __construct(
        public PaginationMetadata $pagination,
        public array $results,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            pagination: PaginationMetadata::fromArray($data['pagination']),
            results: array_map(static fn (array $item) => Union::discriminate($item, 'kind', [
                'aggregations' => AggregationsContext::class,
                'contacts' => ContactsContext::class,
                'domain_forwards' => DomainForwardsContext::class,
                'domain_recommendations' => DomainRecommendationsContext::class,
                'domains' => DomainsContext::class,
                'email_forwards' => EmailForwardsContext::class,
                'zones' => ZonesContext::class,
            ]), $data['results']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'pagination' => $this->pagination,
            'results' => $this->results,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
