<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ObjectLogChange implements ApiModel
{
    /**
     * @param string $field Dot-separated path of the field in the object, for example `renewal_mode` or
     *     `contacts.registrant`
     * @param mixed $newValue Value of the field in this log; `null` when the field was absent
     * @param mixed $oldValue Value of the field in the object's previous log; `null` when the field was absent
     */
    public function __construct(
        public string $field,
        public mixed $newValue,
        public mixed $oldValue,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            field: $data['field'],
            newValue: $data['new_value'],
            oldValue: $data['old_value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'field' => $this->field,
            'new_value' => $this->newValue,
            'old_value' => $this->oldValue,
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
