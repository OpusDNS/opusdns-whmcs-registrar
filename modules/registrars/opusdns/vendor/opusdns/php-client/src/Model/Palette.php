<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final class Palette implements ApiModel
{
    /**
     * @param list<string>|null $chartColors
     * @param list<string>|null $tagColors
     */
    public function __construct(
        public readonly ?string $accent = null,
        public readonly ?string $accentForeground = null,
        public readonly ?string $background = null,
        public readonly ?string $body = null,
        public readonly ?string $bodyForeground = null,
        public readonly ?string $border = null,
        public readonly ?string $card = null,
        public readonly ?string $cardForeground = null,
        public readonly ?array $chartColors = null,
        public readonly ?string $danger = null,
        public readonly ?string $foreground = null,
        public readonly ?string $info = null,
        public readonly ?string $input = null,
        public readonly ?string $link = null,
        public readonly ?string $muted = null,
        public readonly ?string $mutedForeground = null,
        public readonly ?string $primary = null,
        public readonly ?string $primaryForeground = null,
        public readonly ?string $secondary = null,
        public readonly ?string $secondaryForeground = null,
        public readonly ?string $sidebar = null,
        public readonly ?string $sidebarAccent = null,
        public readonly ?string $sidebarAccentForeground = null,
        public readonly ?string $sidebarBorder = null,
        public readonly ?string $sidebarForeground = null,
        public readonly ?string $success = null,
        public readonly ?string $table = null,
        public readonly ?string $tableHeader = null,
        public readonly ?string $tableRow = null,
        public readonly ?string $tableRowInteractive = null,
        public readonly ?array $tagColors = null,
        public readonly ?string $warning = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            accent: $data['accent'] ?? null,
            accentForeground: $data['accent_foreground'] ?? null,
            background: $data['background'] ?? null,
            body: $data['body'] ?? null,
            bodyForeground: $data['body_foreground'] ?? null,
            border: $data['border'] ?? null,
            card: $data['card'] ?? null,
            cardForeground: $data['card_foreground'] ?? null,
            chartColors: $data['chart_colors'] ?? null,
            danger: $data['danger'] ?? null,
            foreground: $data['foreground'] ?? null,
            info: $data['info'] ?? null,
            input: $data['input'] ?? null,
            link: $data['link'] ?? null,
            muted: $data['muted'] ?? null,
            mutedForeground: $data['muted_foreground'] ?? null,
            primary: $data['primary'] ?? null,
            primaryForeground: $data['primary_foreground'] ?? null,
            secondary: $data['secondary'] ?? null,
            secondaryForeground: $data['secondary_foreground'] ?? null,
            sidebar: $data['sidebar'] ?? null,
            sidebarAccent: $data['sidebar_accent'] ?? null,
            sidebarAccentForeground: $data['sidebar_accent_foreground'] ?? null,
            sidebarBorder: $data['sidebar_border'] ?? null,
            sidebarForeground: $data['sidebar_foreground'] ?? null,
            success: $data['success'] ?? null,
            table: $data['table'] ?? null,
            tableHeader: $data['table_header'] ?? null,
            tableRow: $data['table_row'] ?? null,
            tableRowInteractive: $data['table_row_interactive'] ?? null,
            tagColors: $data['tag_colors'] ?? null,
            warning: $data['warning'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'accent' => $this->accent,
            'accent_foreground' => $this->accentForeground,
            'background' => $this->background,
            'body' => $this->body,
            'body_foreground' => $this->bodyForeground,
            'border' => $this->border,
            'card' => $this->card,
            'card_foreground' => $this->cardForeground,
            'chart_colors' => $this->chartColors,
            'danger' => $this->danger,
            'foreground' => $this->foreground,
            'info' => $this->info,
            'input' => $this->input,
            'link' => $this->link,
            'muted' => $this->muted,
            'muted_foreground' => $this->mutedForeground,
            'primary' => $this->primary,
            'primary_foreground' => $this->primaryForeground,
            'secondary' => $this->secondary,
            'secondary_foreground' => $this->secondaryForeground,
            'sidebar' => $this->sidebar,
            'sidebar_accent' => $this->sidebarAccent,
            'sidebar_accent_foreground' => $this->sidebarAccentForeground,
            'sidebar_border' => $this->sidebarBorder,
            'sidebar_foreground' => $this->sidebarForeground,
            'success' => $this->success,
            'table' => $this->table,
            'table_header' => $this->tableHeader,
            'table_row' => $this->tableRow,
            'table_row_interactive' => $this->tableRowInteractive,
            'tag_colors' => $this->tagColors,
            'warning' => $this->warning,
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
