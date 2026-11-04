<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class DomainRenewTransferPendingResponse implements ApiModel
{
    /**
     * @param string $name The domain name the renewal was requested for
     * @param string $requestId Identifier of the transfer this renewal started
     * @param string $status The domain is held at another registrar, so the renewal transfers it into OpusDNS. The
     *     outcome is reported as domain events.
     */
    public function __construct(
        public string $name,
        public string $requestId,
        public string $status = 'transfer_pending',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            name: $data['name'],
            requestId: $data['request_id'],
            status: $data['status'] ?? 'transfer_pending',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'name' => $this->name,
            'request_id' => $this->requestId,
            'status' => $this->status,
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
