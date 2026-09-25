<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

use OpusDNS\Client\Exception\HttpException;
use OpusDNS\Client\Exception\ValidationException;
use Throwable;

class ErrorHelper
{
    /**
     * Returns the error message to show in WHMCS for a failed API call.
     */
    public static function message(Throwable $exception): string
    {
        if ($exception instanceof ValidationException) {
            $errors = $exception->errors();
            $fieldErrors = array_filter($errors, static fn (array $error): bool => isset($error['msg']));

            if ($errors !== [] && count($fieldErrors) === count($errors)) {
                return implode('; ', $exception->messages());
            }
        }

        if ($exception instanceof HttpException) {
            $title = $exception->problemTitle;
            $detail = $exception->problemDetail;

            if ($title !== null && $detail !== null && $detail !== $title) {
                return "{$title}: {$detail}";
            }

            return $detail ?? $title ?? $exception->getMessage();
        }

        return $exception->getMessage();
    }
}
