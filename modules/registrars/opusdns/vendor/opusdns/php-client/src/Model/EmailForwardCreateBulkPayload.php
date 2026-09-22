<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardCreateBulkPayload implements ApiModel
{
    /**
     * @param list<EmailForwardCreateBulkInstance> $instances List of email forwards to create (1-1000)
     * @param EmailForwardCreateBulkTemplate $template Shared settings for all email forwards
     */
    public function __construct(
        public array $instances,
        public EmailForwardCreateBulkTemplate $template,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            instances: array_map(static fn (array $item): EmailForwardCreateBulkInstance => EmailForwardCreateBulkInstance::fromArray($item), $data['instances']),
            template: EmailForwardCreateBulkTemplate::fromArray($data['template']),
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
