<?php

declare(strict_types=1);

namespace OpusDNS\Client\Exception;

/**
 * 422 Unprocessable Entity: the request failed validation. Each error names the offending field.
 */
final class ValidationException extends HttpException
{
    /**
     * Raw validation errors as sent by the API.
     *
     * @return list<array{loc?: list<string|int>, msg?: string, type?: string, input?: mixed, ctx?: array<string, mixed>}>
     */
    public function errors(): array
    {
        $errors = $this->body['errors'] ?? [];

        return is_array($errors) ? array_values(array_filter($errors, is_array(...))) : [];
    }

    /**
     * Human-readable messages, one per error, as "field.path: message".
     *
     * @return list<string>
     */
    public function messages(): array
    {
        $messages = [];
        foreach ($this->errors() as $error) {
            $location = implode('.', array_map(strval(...), array_filter($error['loc'] ?? [], is_scalar(...))));
            $message = (string) ($error['msg'] ?? 'invalid');
            $messages[] = $location === '' ? $message : "{$location}: {$message}";
        }

        return $messages;
    }
}
