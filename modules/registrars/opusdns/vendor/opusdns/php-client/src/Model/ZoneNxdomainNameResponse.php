<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ZoneNxdomainNameResponse implements ApiModel
{
    /**
     * @param \DateTimeImmutable $firstListedDate First day in the window the name was listed on (UTC)
     * @param \DateTimeImmutable $lastListedDate Last day in the window the name was listed on (UTC)
     * @param int $listedDays Days in the window the name was listed on: days with more than 30 NXDOMAIN answers to
     *     it
     * @param int $nxdomainCount NXDOMAIN answers to this name and type in the window, summed over the days it was
     *     listed on
     * @param string $qname The name queried, with a trailing dot
     * @param string $qtype The type it was queried with, such as A, AAAA or TXT
     */
    public function __construct(
        public \DateTimeImmutable $firstListedDate,
        public \DateTimeImmutable $lastListedDate,
        public int $listedDays,
        public int $nxdomainCount,
        public string $qname,
        public string $qtype,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            firstListedDate: Serializer::parseDate($data['first_listed_date']),
            lastListedDate: Serializer::parseDate($data['last_listed_date']),
            listedDays: $data['listed_days'],
            nxdomainCount: $data['nxdomain_count'],
            qname: $data['qname'],
            qtype: $data['qtype'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'first_listed_date' => $this->firstListedDate->format('Y-m-d'),
            'last_listed_date' => $this->lastListedDate->format('Y-m-d'),
            'listed_days' => $this->listedDays,
            'nxdomain_count' => $this->nxdomainCount,
            'qname' => $this->qname,
            'qtype' => $this->qtype,
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
