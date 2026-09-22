<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Model\BodyUploadWhitelabelAssetV1WhitelabelBrandingAssetsPost;
use OpusDNS\Client\Model\BrandingAsset;
use OpusDNS\Client\Model\BrandingDocument;
use OpusDNS\Client\Model\ListBrandingAssetsResponse;
use OpusDNS\Client\Model\MailTemplate;
use OpusDNS\Client\Model\PreviewMailReq;
use OpusDNS\Client\Model\PreviewMailRes;
use OpusDNS\Client\Model\ProductCreateRes;
use OpusDNS\Client\Model\WhitelabelBaseCreate;
use OpusDNS\Client\Model\WhitelabelBrandingPatch;
use OpusDNS\Client\Model\WhitelabelBrandingRecheck;
use OpusDNS\Client\Model\WhitelabelBrandingResponse;
use OpusDNS\Client\Model\WhitelabelPlusCreate;
use OpusDNS\Client\Model\WhitelabelUpgradeToPlus;
use OpusDNS\Client\Union;

/**
 * Operations tagged "whitelabel".
 */
final class WhitelabelService
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * Get the organization's whitelabel branding config
     *
     * Required permissions: whitelabel_branding:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getWhitelabelBranding(?string $xDatetimeFormat = null): WhitelabelBrandingResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::WHITELABEL_BRANDING,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): WhitelabelBrandingResponse => WhitelabelBrandingResponse::fromArray($data));
    }

    /**
     * Buy the organization's whitelabel branding (base or plus tier)
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param WhitelabelBaseCreate|WhitelabelPlusCreate|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function createWhitelabelBranding(
        WhitelabelBaseCreate|WhitelabelPlusCreate|array $body,
        ?string $xDatetimeFormat = null,
    ): ProductCreateRes {
        $response = $this->client->request(
            'POST',
            Endpoint::WHITELABEL_BRANDING,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ProductCreateRes => ProductCreateRes::fromArray($data));
    }

    /**
     * Change the organization's whitelabel branding config (relabel / enable / renewal mode)
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param WhitelabelBrandingPatch|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function patchWhitelabelBranding(
        WhitelabelBrandingPatch|array $body,
        ?string $xDatetimeFormat = null,
    ): WhitelabelBrandingResponse {
        $response = $this->client->request(
            'PATCH',
            Endpoint::WHITELABEL_BRANDING,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): WhitelabelBrandingResponse => WhitelabelBrandingResponse::fromArray($data));
    }

    /**
     * List uploaded branding assets
     *
     * Required permissions: whitelabel_branding:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function listWhitelabelAssets(?string $xDatetimeFormat = null): ListBrandingAssetsResponse
    {
        $response = $this->client->request(
            'GET',
            Endpoint::WHITELABEL_BRANDING_ASSETS,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ListBrandingAssetsResponse => ListBrandingAssetsResponse::fromArray($data));
    }

    /**
     * Upload a branding asset
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param BodyUploadWhitelabelAssetV1WhitelabelBrandingAssetsPost|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function uploadWhitelabelAsset(
        BodyUploadWhitelabelAssetV1WhitelabelBrandingAssetsPost|array $body,
        ?string $xDatetimeFormat = null,
    ): BrandingAsset {
        $response = $this->client->request(
            'POST',
            Endpoint::WHITELABEL_BRANDING_ASSETS,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
            contentType: 'multipart/form-data',
        );

        return $this->client->hydrate($response, static fn (array $data): BrandingAsset => BrandingAsset::fromArray($data));
    }

    /**
     * Delete an uploaded branding asset
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function deleteWhitelabelAsset(string $assetId, ?string $xDatetimeFormat = null): void
    {
        $this->client->request(
            'DELETE',
            Endpoint::WHITELABEL_BRANDING_ASSETS_BY_ASSET_ID,
            path: ['asset_id' => $assetId],
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );
    }

    /**
     * Get the stored branding document
     *
     * Required permissions: whitelabel_branding:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function getWhitelabelDocument(?string $xDatetimeFormat = null): BrandingDocument
    {
        $response = $this->client->request(
            'GET',
            Endpoint::WHITELABEL_BRANDING_DOCUMENT,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): BrandingDocument => BrandingDocument::fromArray($data));
    }

    /**
     * Upsert the branding document
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param BrandingDocument|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function putWhitelabelDocumentPost(
        BrandingDocument|array $body,
        ?string $xDatetimeFormat = null,
    ): BrandingDocument {
        $response = $this->client->request(
            'POST',
            Endpoint::WHITELABEL_BRANDING_DOCUMENT,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): BrandingDocument => BrandingDocument::fromArray($data));
    }

    /**
     * Upsert the branding document
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param BrandingDocument|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function putWhitelabelDocumentPut(
        BrandingDocument|array $body,
        ?string $xDatetimeFormat = null,
    ): BrandingDocument {
        $response = $this->client->request(
            'PUT',
            Endpoint::WHITELABEL_BRANDING_DOCUMENT,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): BrandingDocument => BrandingDocument::fromArray($data));
    }

    /**
     * Preview a transactional email template with a draft branding document
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param PreviewMailReq|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function previewWhitelabelEmail(
        PreviewMailReq|array $body,
        ?string $xDatetimeFormat = null,
    ): PreviewMailRes {
        $response = $this->client->request(
            'POST',
            Endpoint::WHITELABEL_BRANDING_EMAIL_PREVIEW,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): PreviewMailRes => PreviewMailRes::fromArray($data));
    }

    /**
     * List the editable transactional email templates and their content blocks
     *
     * Required permissions: whitelabel_branding:read
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     * @return array<string, MailTemplate>
     */
    public function listWhitelabelEmailTemplates(?string $xDatetimeFormat = null): array
    {
        $response = $this->client->request(
            'GET',
            Endpoint::WHITELABEL_BRANDING_EMAIL_TEMPLATES,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): array => array_map(static fn (array $value): MailTemplate => MailTemplate::fromArray($value), $data));
    }

    /**
     * Re-run onboarding for the organization's whitelabel branding config
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param WhitelabelBrandingRecheck|array<string, mixed>|null $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function recheckWhitelabelBranding(
        WhitelabelBrandingRecheck|array|null $body = null,
        ?string $xDatetimeFormat = null,
    ): WhitelabelBrandingResponse {
        $response = $this->client->request(
            'POST',
            Endpoint::WHITELABEL_BRANDING_RECHECK,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): WhitelabelBrandingResponse => WhitelabelBrandingResponse::fromArray($data));
    }

    /**
     * Restore a terminated whitelabel (re-enable and reprovision from the preserved state)
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function restoreWhitelabelBranding(?string $xDatetimeFormat = null): WhitelabelBrandingResponse
    {
        $response = $this->client->request(
            'POST',
            Endpoint::WHITELABEL_BRANDING_RESTORE,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): WhitelabelBrandingResponse => WhitelabelBrandingResponse::fromArray($data));
    }

    /**
     * Upgrade the whitelabel to the plus tier (served on the customer's own domain)
     *
     * Required permissions: whitelabel_branding:manage
     *
     * @param WhitelabelUpgradeToPlus|array<string, mixed> $body
     * @param string|null $xDatetimeFormat Accepted for backwards compatibility; has no effect. Response datetimes
     *     are always normalized to UTC and serialized as RFC 3339 with a `Z` suffix, whether or not this header is
     *     sent.
     */
    public function upgradeWhitelabelToPlus(
        WhitelabelUpgradeToPlus|array $body,
        ?string $xDatetimeFormat = null,
    ): ProductCreateRes {
        $response = $this->client->request(
            'POST',
            Endpoint::WHITELABEL_BRANDING_TIER,
            body: $body,
            headers: ['X-Datetime-Format' => $xDatetimeFormat],
        );

        return $this->client->hydrate($response, static fn (array $data): ProductCreateRes => ProductCreateRes::fromArray($data));
    }
}
