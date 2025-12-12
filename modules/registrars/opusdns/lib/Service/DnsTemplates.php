<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

class DnsTemplates
{
    private static string $templatesPath = __DIR__ . '/../../resources/dns-templates/';
    private static ?array $templates = null;

    public static function listTemplates(): array
    {
        return self::loadTemplates();
    }

    private static function loadTemplates(): array
    {
        if (self::$templates !== null) {
            return self::$templates;
        }

        self::$templates = [];

        foreach (glob(self::$templatesPath . '*.json') as $file) {
            $content = json_decode(file_get_contents($file), true);

            if (json_last_error() === JSON_ERROR_NONE && isset($content['id'])) {
                self::$templates[] = $content;
            }
        }

        return self::$templates;
    }
}
