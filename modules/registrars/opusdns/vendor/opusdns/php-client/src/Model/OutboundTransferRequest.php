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

final readonly class OutboundTransferRequest implements ApiModel
{
    /**
     * @param OutboundTransferAction|string $action Whether to approve or reject the pending outbound transfer
     */
    public function __construct(
        public OutboundTransferAction|string $action,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            action: OutboundTransferAction::tryFrom($data['action']) ?? $data['action'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'action' => $this->action,
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
