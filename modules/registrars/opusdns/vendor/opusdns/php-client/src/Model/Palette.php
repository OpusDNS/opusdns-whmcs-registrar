<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;

final readonly class Palette implements ApiModel
{
    /**
     * @param list<string>|null $chartColors
     * @param list<string>|null $tagColors
     */
    public function __construct(
        public ?string $accent = null,
        public ?string $accentForeground = null,
        public ?string $background = null,
        public ?string $body = null,
        public ?string $bodyForeground = null,
        public ?string $border = null,
        public ?string $card = null,
        public ?string $cardForeground = null,
        public ?array $chartColors = null,
        public ?string $danger = null,
        public ?string $foreground = null,
        public ?string $info = null,
        public ?string $input = null,
        public ?string $link = null,
        public ?string $muted = null,
        public ?string $mutedForeground = null,
        public ?string $primary = null,
        public ?string $primaryForeground = null,
        public ?string $secondary = null,
        public ?string $secondaryForeground = null,
        public ?string $sidebar = null,
        public ?string $sidebarAccent = null,
        public ?string $sidebarAccentForeground = null,
        public ?string $sidebarBorder = null,
        public ?string $sidebarForeground = null,
        public ?string $success = null,
        public ?string $table = null,
        public ?string $tableHeader = null,
        public ?string $tableRow = null,
        public ?string $tableRowInteractive = null,
        public ?array $tagColors = null,
        public ?string $warning = null,
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
