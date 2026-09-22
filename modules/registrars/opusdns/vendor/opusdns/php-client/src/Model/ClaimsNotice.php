<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class ClaimsNotice implements ApiModel
{
    /**
     * @param string $claimsKey The claims key used to retrieve this claims notice
     * @param string $claimsNoticeAcceptanceHash Hash to accept the claims notice
     * @param string $label Domain name label covered by this claims notice
     * @param list<TmClaim>|null $claims List of trademark claims
     * @param string $noticeFooter Claims notice form footer text
     * @param string $noticeFooterUrl Claims notice form footer URL
     * @param string $noticeIntro Introductory text for the claims notice
     * @param string $noticeNotExactMatchIntro Introductory text for the non-exact match section
     * @param string $noticeTitle Title for the claims notice
     * @param string $renderedHtml The rendered trademark claims notice HTML
     */
    public function __construct(
        public string $claimsKey,
        public string $claimsNoticeAcceptanceHash,
        public string $label,
        public ?array $claims = null,
        public string $noticeFooter = '',
        public string $noticeFooterUrl = '',
        public string $noticeIntro = '',
        public string $noticeNotExactMatchIntro = '',
        public string $noticeTitle = '',
        public string $renderedHtml = '',
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            claimsKey: $data['claims_key'],
            claimsNoticeAcceptanceHash: $data['claims_notice_acceptance_hash'],
            label: $data['label'],
            claims: isset($data['claims']) ? array_map(static fn (array $item): TmClaim => TmClaim::fromArray($item), $data['claims']) : null,
            noticeFooter: $data['notice_footer'] ?? '',
            noticeFooterUrl: $data['notice_footer_url'] ?? '',
            noticeIntro: $data['notice_intro'] ?? '',
            noticeNotExactMatchIntro: $data['notice_not_exact_match_intro'] ?? '',
            noticeTitle: $data['notice_title'] ?? '',
            renderedHtml: $data['rendered_html'] ?? '',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'claims_key' => $this->claimsKey,
            'claims_notice_acceptance_hash' => $this->claimsNoticeAcceptanceHash,
            'label' => $this->label,
            'claims' => $this->claims,
            'notice_footer' => $this->noticeFooter,
            'notice_footer_url' => $this->noticeFooterUrl,
            'notice_intro' => $this->noticeIntro,
            'notice_not_exact_match_intro' => $this->noticeNotExactMatchIntro,
            'notice_title' => $this->noticeTitle,
            'rendered_html' => $this->renderedHtml,
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
