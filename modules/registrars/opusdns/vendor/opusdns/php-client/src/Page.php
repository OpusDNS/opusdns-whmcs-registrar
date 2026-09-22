<?php

declare(strict_types=1);

namespace OpusDNS\Client;

use OpusDNS\Client\Model\PaginationMetadata;

/**
 * One page of a paginated listing. Implemented by every generated model that carries results and pagination.
 *
 * @template T
 */
interface Page
{
    /** @return list<T> */
    public function results(): array;

    public function pagination(): PaginationMetadata;
}
