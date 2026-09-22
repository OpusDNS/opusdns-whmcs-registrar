<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardUpdateBulkPayload implements ApiModel
{
    /**
     * @param list<EmailForwardUpdateBulkInstance> $instances List of email forwards to update (1-1000)
     * @param EmailForwardUpdateBulkTemplate $template Shared settings for all email forwards
     */
    public function __construct(
        public array $instances,
        public EmailForwardUpdateBulkTemplate $template,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            instances: array_map(static fn (array $item): EmailForwardUpdateBulkInstance => EmailForwardUpdateBulkInstance::fromArray($item), $data['instances']),
            template: EmailForwardUpdateBulkTemplate::fromArray($data['template']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'instances' => $this->instances,
            'template' => $this->template,
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
