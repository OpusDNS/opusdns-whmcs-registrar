<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class BrandingDesignContextPayload implements ApiModel
{
    /**
     * @param list<BrandingDesignVariant> $results
     */
    public function __construct(
        public array $results,
        public ?BrandingDesignActions $actions = null,
        public ?BrandingDesignDiff $diff = null,
        public ?BrandingDesignSource $source = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            results: array_map(static fn (array $item): BrandingDesignVariant => BrandingDesignVariant::fromArray($item), $data['results']),
            actions: isset($data['actions']) ? BrandingDesignActions::fromArray($data['actions']) : null,
            diff: isset($data['diff']) ? BrandingDesignDiff::fromArray($data['diff']) : null,
            source: isset($data['source']) ? BrandingDesignSource::fromArray($data['source']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'results' => $this->results,
            'actions' => $this->actions,
            'diff' => $this->diff,
            'source' => $this->source,
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
