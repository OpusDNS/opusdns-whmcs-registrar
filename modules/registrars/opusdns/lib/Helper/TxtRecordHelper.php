<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

class TxtRecordHelper
{
    public static function normalize(string $value): string
    {
        $trimmed = trim($value);

        if (empty($trimmed)) {
            return '""';
        }

        if (preg_match_all('/"(?:[^"\\\\]|\\\\.)*"/', $trimmed, $matches)) {
            $quotedStrings = $matches[0];
            if (implode(' ', $quotedStrings) === $trimmed) {
                return $trimmed;
            }
        }

        $content = preg_replace('/^"|"$/', '', $trimmed);

        if (empty($content)) {
            return '""';
        }

        $escapedContent = self::escapeQuotes($content);

        return '"' . $escapedContent . '"';
    }

    private static function escapeQuotes(string $str): string
    {
        return str_replace('"', '\\"', $str);
    }
}
