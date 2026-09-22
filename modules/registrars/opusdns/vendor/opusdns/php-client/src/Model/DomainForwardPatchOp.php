<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\PatchOp;
use OpusDNS\Client\Serializer;
use OpusDNS\Client\Union;

final readonly class DomainForwardPatchOp implements ApiModel
{
    /**
     * @param HttpRedirectUpsert|HttpRedirectRemove $redirect
     */
    public function __construct(
        public PatchOp|string $op,
        public HttpRedirectUpsert|HttpRedirectRemove $redirect,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            op: PatchOp::tryFrom($data['op']) ?? $data['op'],
            redirect: Union::hydrate($data['redirect'], [HttpRedirectUpsert::class => ['request_path', 'target_protocol', 'target_hostname', 'target_path', 'redirect_code', 'request_protocol', 'request_hostname'], HttpRedirectRemove::class => ['request_protocol', 'request_hostname', 'request_path']]),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'op' => $this->op,
            'redirect' => $this->redirect,
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
