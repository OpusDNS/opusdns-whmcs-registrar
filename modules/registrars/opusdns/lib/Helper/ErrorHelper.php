<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

use OpusDNS\Client\Exception\HttpException;
use OpusDNS\Client\Exception\ValidationException;
use Throwable;

class ErrorHelper
{
    /**
     * The message shown in WHMCS for a failed API call: the validation messages of a 422, the problem
     * details of any other HTTP error, or the exception message.
     */
    public static function message(Throwable $exception): string
    {
        if ($exception instanceof ValidationException) {
            $messages = $exception->messages();
            if ($messages !== []) {
                return implode('; ', $messages);
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
