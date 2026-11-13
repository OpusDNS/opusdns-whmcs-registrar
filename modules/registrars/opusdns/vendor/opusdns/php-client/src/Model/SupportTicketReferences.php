<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class SupportTicketReferences implements ApiModel
{
    /**
     * @param list<string> $batchIds
     * @param list<string> $domains Domain names, ACE, lower case.
     * @param list<string> $jobIds
     * @param list<string> $requestIds Server request ids (the X-Server-Request-ID header), 32 hex digits.
     */
    public function __construct(
        public readonly array $batchIds,
        public readonly array $domains,
        public readonly array $jobIds,
        public readonly array $requestIds,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            batchIds: $data['batch_ids'],
            domains: $data['domains'],
            jobIds: $data['job_ids'],
            requestIds: $data['request_ids'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'batch_ids' => $this->batchIds,
            'domains' => $this->domains,
            'job_ids' => $this->jobIds,
            'request_ids' => $this->requestIds,
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
