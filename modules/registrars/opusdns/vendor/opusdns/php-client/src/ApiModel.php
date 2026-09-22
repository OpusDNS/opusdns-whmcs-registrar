<?php

declare(strict_types=1);

namespace OpusDNS\Client;

/**
 * Implemented by every generated model.
 */
interface ApiModel extends \JsonSerializable
{
    /** @param array<string, mixed> $data Decoded JSON object as returned by the API */
    public static function fromArray(array $data): static;

    /**
     * JSON-ready representation. Null properties are omitted; pass a plain array to an API method to send explicit nulls.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array;

    /** @return array<string, mixed> */
    public function jsonSerialize(): array;
}
