<?php

declare(strict_types=1);

namespace OpusDNS\Client;

/**
 * Walks paginated listings page by page.
 *
 * The callback receives a page number and returns that page, typically by calling a listing method:
 *
 *     Paginator::items(fn (int $page) => $client->domain()->getDomains(page: $page, pageSize: 100))
 *
 * Iteration stops when the API reports no next page, when the last page number is reached, when a page comes
 * back empty, or when $maxPages pages have been fetched.
 */
final class Paginator
{
    /**
     * Yields every item of every page.
     *
     * @template T
     * @param callable(int): Page<T> $fetchPage
     * @return \Generator<int, T>
     */
    public static function items(callable $fetchPage, int $firstPage = 1, ?int $maxPages = null): \Generator
    {
        foreach (self::pages($fetchPage, $firstPage, $maxPages) as $page) {
            foreach ($page->results() as $item) {
                yield $item;
            }
        }
    }

    /**
     * Yields every page, keyed by its page number, for callers that need the pagination metadata.
     *
     * @template T
     * @param callable(int): Page<T> $fetchPage
     * @return \Generator<int, Page<T>>
     */
    public static function pages(callable $fetchPage, int $firstPage = 1, ?int $maxPages = null): \Generator
    {
        if ($firstPage < 1) {
            throw new \InvalidArgumentException('Page numbers start at 1.');
        }
        if ($maxPages !== null && $maxPages < 1) {
            throw new \InvalidArgumentException('maxPages must be at least 1.');
        }

        $number = $firstPage;
        $fetched = 0;
        while (true) {
            $page = $fetchPage($number);
            $fetched++;
            yield $number => $page;

            $metadata = $page->pagination();
            $exhausted = !$metadata->hasNextPage
                || $page->results() === []
                || ($metadata->totalPages > 0 && $metadata->currentPage >= $metadata->totalPages);
            if ($exhausted || ($maxPages !== null && $fetched >= $maxPages)) {
                return;
            }
            $number++;
        }
    }
}
