<?php

declare(strict_types=1);

namespace OpusDNS\Client;

use Psr\Http\Message\StreamInterface;

/**
 * Converts PHP values to what the API expects on the wire.
 */
final class Serializer
{
    /**
     * Recursively converts models, enums and dates to JSON-ready values. Null entries of objects are dropped.
     * An empty stdClass passes through and encodes as an empty JSON object.
     */
    public static function normalize(mixed $value): mixed
    {
        if ($value instanceof ApiModel) {
            return $value->toArray();
        }
        if ($value instanceof \BackedEnum) {
            return $value->value;
        }
        if ($value instanceof \DateTimeInterface) {
            return self::dateTime($value);
        }
        if ($value instanceof StreamInterface || $value instanceof \stdClass || is_resource($value)) {
            return $value;
        }
        if (is_array($value)) {
            if (array_is_list($value)) {
                return array_map(self::normalize(...), $value);
            }
            $result = [];
            foreach ($value as $key => $item) {
                if ($item !== null) {
                    $result[$key] = self::normalize($item);
                }
            }

            return $result;
        }
        if (is_object($value)) {
            throw new \InvalidArgumentException('Cannot serialize an object of class ' . $value::class);
        }

        return $value;
    }

    /** UTC RFC 3339 timestamp with a Z suffix. */
    public static function dateTime(\DateTimeInterface $value): string
    {
        return \DateTimeImmutable::createFromInterface($value)
            ->setTimezone(new \DateTimeZone('UTC'))
            ->format('Y-m-d\TH:i:s\Z');
    }

    /** A calendar date such as "2026-09-01" as midnight UTC, independent of the process timezone. */
    public static function parseDate(string $value): \DateTimeImmutable
    {
        $date = \DateTimeImmutable::createFromFormat('!Y-m-d', $value, new \DateTimeZone('UTC'));
        if ($date === false || $date->format('Y-m-d') !== $value) {
            throw new \UnexpectedValueException("Expected a date in Y-m-d form, got \"{$value}\"");
        }

        return $date;
    }

    /**
     * Fills the {placeholders} of a path template.
     *
     * @param array<string, string|int|float|bool|\BackedEnum> $params
     */
    public static function path(string $template, array $params): string
    {
        return (string) preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', static function (array $match) use ($params, $template): string {
            if (!array_key_exists($match[1], $params)) {
                throw new \InvalidArgumentException("Missing path parameter '{$match[1]}' for {$template}");
            }

            return rawurlencode(self::scalar($params[$match[1]]));
        }, $template);
    }

    /**
     * Builds a query string. Null values are omitted, lists become repeated keys, enums, bools and dates are converted.
     *
     * @param array<string, mixed> $params
     */
    public static function query(array $params): string
    {
        $pairs = [];
        foreach ($params as $name => $value) {
            if ($value === null) {
                continue;
            }
            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item !== null) {
                    $pairs[] = rawurlencode((string) $name) . '=' . rawurlencode(self::scalar($item));
                }
            }
        }

        return $pairs === [] ? '' : '?' . implode('&', $pairs);
    }

    /**
     * Encodes multipart/form-data. Stream and resource values become file parts.
     *
     * @param array<string, mixed> $fields
     * @return array{string, string} Body and Content-Type header value
     */
    public static function multipart(array $fields): array
    {
        $boundary = bin2hex(random_bytes(16));
        $body = '';
        foreach ($fields as $name => $value) {
            $body .= "--{$boundary}\r\n";
            $fieldName = self::multipartQuoted((string) $name);
            if ($value instanceof StreamInterface || is_resource($value)) {
                if ($value instanceof StreamInterface) {
                    $content = (string) $value;
                    $uri = $value->getMetadata('uri');
                } else {
                    $content = (string) stream_get_contents($value);
                    $uri = stream_get_meta_data($value)['uri'] ?? null;
                }
                $filename = self::multipartQuoted(basename(is_string($uri) && $uri !== '' ? $uri : (string) $name));
                $body .= "Content-Disposition: form-data; name=\"{$fieldName}\"; filename=\"{$filename}\"\r\n";
                $body .= "Content-Type: application/octet-stream\r\n\r\n{$content}\r\n";
            } else {
                $body .= "Content-Disposition: form-data; name=\"{$fieldName}\"\r\n\r\n" . self::scalar($value) . "\r\n";
            }
        }
        $body .= "--{$boundary}--\r\n";

        return [$body, "multipart/form-data; boundary={$boundary}"];
    }

    /** Percent-encodes the characters that cannot appear inside a quoted Content-Disposition parameter. */
    private static function multipartQuoted(string $value): string
    {
        return strtr($value, ['"' => '%22', "\r" => '%0D', "\n" => '%0A']);
    }

    private static function scalar(mixed $value): string
    {
        if ($value instanceof \BackedEnum) {
            return (string) $value->value;
        }
        if ($value instanceof \DateTimeInterface) {
            return self::dateTime($value);
        }
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_scalar($value)) {
            return (string) $value;
        }

        throw new \InvalidArgumentException('Expected a scalar, enum or date, got ' . get_debug_type($value));
    }
}
