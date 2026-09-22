<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * Public per-model AI inference usage. Deliberately excludes billing-gateway's internal COGS fields
 * (cost_amount, per-million rates, has_rate).
 */
final readonly class AiInferenceUsageGroup implements ApiModel
{
    public function __construct(
        public int $cacheReadTokens,
        public int $cacheWriteTokens,
        public int $inputTokens,
        public string $model,
        public int $outputTokens,
        public int $requestCount,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            cacheReadTokens: $data['cache_read_tokens'],
            cacheWriteTokens: $data['cache_write_tokens'],
            inputTokens: $data['input_tokens'],
            model: $data['model'],
            outputTokens: $data['output_tokens'],
            requestCount: $data['request_count'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'cache_read_tokens' => $this->cacheReadTokens,
            'cache_write_tokens' => $this->cacheWriteTokens,
            'input_tokens' => $this->inputTokens,
            'model' => $this->model,
            'output_tokens' => $this->outputTokens,
            'request_count' => $this->requestCount,
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
