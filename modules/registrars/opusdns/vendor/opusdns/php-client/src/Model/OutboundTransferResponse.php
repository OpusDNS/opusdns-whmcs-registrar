<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\OutboundTransferAction;
use OpusDNS\Client\Serializer;

final readonly class OutboundTransferResponse implements ApiModel
{
    /**
     * @param OutboundTransferAction|string $action The action that was applied to the outbound transfer
     * @param string $domainId The ID of the domain whose outbound transfer was resolved TypeID prefix: domain.
     * @param string $domainName The name of the domain whose outbound transfer was resolved
     */
    public function __construct(
        public OutboundTransferAction|string $action,
        public string $domainId,
        public string $domainName,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            action: OutboundTransferAction::tryFrom($data['action']) ?? $data['action'],
            domainId: $data['domain_id'],
            domainName: $data['domain_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'action' => $this->action,
            'domain_id' => $this->domainId,
            'domain_name' => $this->domainName,
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
