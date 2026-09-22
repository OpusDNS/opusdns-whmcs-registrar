<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

/**
 * A single trademark claim within a notice (claimType in RFC 9361)
 */
final readonly class TmClaim implements ApiModel
{
    /**
     * @param string $goodsAndServices Full description of goods and services
     * @param list<TmHolder> $holders One or more holders of the mark
     * @param TmJurDesc $jurDesc Jurisdiction where the mark is protected
     * @param string $markName Mark text string
     * @param list<TmClassDesc>|null $classDescs Nice Classification descriptions
     * @param list<TmContact>|null $contacts Zero or more contacts/representatives
     * @param TmNotExactMatch|null $notExactMatch Present if claim added by non-exact match rule
     */
    public function __construct(
        public string $goodsAndServices,
        public array $holders,
        public TmJurDesc $jurDesc,
        public string $markName,
        public ?array $classDescs = null,
        public ?array $contacts = null,
        public ?TmNotExactMatch $notExactMatch = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            goodsAndServices: $data['goods_and_services'],
            holders: array_map(static fn (array $item): TmHolder => TmHolder::fromArray($item), $data['holders']),
            jurDesc: TmJurDesc::fromArray($data['jur_desc']),
            markName: $data['mark_name'],
            classDescs: isset($data['class_descs']) ? array_map(static fn (array $item): TmClassDesc => TmClassDesc::fromArray($item), $data['class_descs']) : null,
            contacts: isset($data['contacts']) ? array_map(static fn (array $item): TmContact => TmContact::fromArray($item), $data['contacts']) : null,
            notExactMatch: isset($data['not_exact_match']) ? TmNotExactMatch::fromArray($data['not_exact_match']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'goods_and_services' => $this->goodsAndServices,
            'holders' => $this->holders,
            'jur_desc' => $this->jurDesc,
            'mark_name' => $this->markName,
            'class_descs' => $this->classDescs,
            'contacts' => $this->contacts,
            'not_exact_match' => $this->notExactMatch,
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
